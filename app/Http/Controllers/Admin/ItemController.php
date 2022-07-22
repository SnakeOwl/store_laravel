<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Models\Parameter;
use App\Models\Galery;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

define('IMAGES_DIRECTORY', 'images'); // папка для хранения изображений

class ItemController extends Controller
{
    public function index()
    {
        return view('admin.items.index', [ 'items' => Item::withTrashed()->get() ]);
    }

    public function create()
    {
        return view('admin.items.form', ['categories' => Category::all()]);
    }

    public function store(CreateItemRequest $request)
    {
        $message = "";
        $params = $request->all();

        if ($request->hasFile('short-image'))
        {
            $f_path = $request->File('short-image')->store(IMAGES_DIRECTORY);
            $params['short_image'] = $f_path;
        }

        $params['alias'] =  transliterator_transliterate( 'Any-Latin; Latin-ASCII; Lower()', $params['name']);

        unset($params['names']);
        unset($params['values']);
        unset($params['galery-images']);

        $item = Item::create($params);

        if ($request->hasFile('galery-images') )
        {
            $images = $request->File('galery-images');

            foreach ($images as $file)
            {
                if ($file->isValid())
                {
                    $f_path = $file->store(IMAGES_DIRECTORY);
                    $data = [
                        'item_id' => $item->id,
                        'image' => $f_path
                    ];
                    Galery::create($data);
                    $f_path = null;
                }
            }
        }

        $parameters['names'] = $request->input('param_key');
        $parameters['values'] = $request->input('param_val');
        $count = count($parameters['names']);
        for ($i = 0; $i < $count; $i++)
        {
            if ($parameters['names'][$i] != false)
            {
                $param = [
                    'item_id' => $item->id,
                    'param_name' => $parameters['names'][$i],
                    'param_value' => $parameters['values'][$i],
                ];
                Parameter::create($param);
            }
        }

        session()->flash('info', 'Товар добавлен');

        return redirect()->route('items.index');
    }

    public function edit(Item $item)
    {
        return view('admin.items.form', [
            'item' => $item,
            'categories' => Category::all()
        ]);
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        $message = "";
        $params = $request->all();
        foreach (['new', 'hit'] as $field) {
            if(!$request->has($field))
            {
                $params[$field] = 0;
            }
        }

        if ($request->hasFile('short-image'))
        {
            // сначала удалю старую картинку
            Storage::delete($item->short_image);

            // теперь сохраню новую картинку
            $f_path = $request->File('short-image')->store(IMAGES_DIRECTORY);
            $params['short_image'] = $f_path;
        }

        $params['alias'] =  transliterator_transliterate( 'Any-Latin; Latin-ASCII; Lower()', $params['name']);
        unset($params['param_key']);
        unset($params['param_val']);
        unset($params['galery-images']);
        unset($params['old-images']);
        $item->update($params);

        //удаляю старые хакартеристики
        $item->parameters()->delete();

        //добавляю новые
        $parameters['names'] = $request->input('param_key');
        $parameters['values'] = $request->input('param_val');
        $count = count($parameters['names']);
        for ($i = 0; $i < $count; $i++)
        {
            if ($parameters['names'][$i] != false)
            {
                $param = [
                    'item_id' => $item->id,
                    'param_name' => $parameters['names'][$i],
                    'param_value' => $parameters['values'][$i],
                ];
                Parameter::create($param);
            }
        }

        $current_images = $item->images;
        $old_images = is_array( $request->input('old_images') )? $request->input('old_images') :array();
        $current_images = is_array( $current_images )? $current_images :array();

        if ( count($current_images) != count($old_images) )
        {
            foreach ($current_images as $image) {
                if( !in_array($image->image , $old_images))
                {
                    Storage::delete($image->image);
                    Galery::find($image->id)->delete();
                }
            }
        }


        if ($request->hasFile('galery-images') )
        {
            $images = $request->File('galery-images');

            if($images != false)
            {
                foreach ($images as $file)
                {
                    if ($file->isValid())
                    {
                        $f_path = $file->store(IMAGES_DIRECTORY);
                        $data = [
                            'item_id' => $item->id,
                            'image' => $f_path
                        ];
                        Galery::create($data);
                        $f_path = null;
                    }
                }
            }
        }

        session()->flash('info', 'Товар изменен');

        return redirect()->route('items.index');
    }

    public function destroy($id)
    {
        // Galery::where('item_id', $id)->delete();
        // Parameter::where('item_id', $id)->delete();
        Item::findOrFail($id)->delete();

        return redirect()->route('items.index')->with('message', 'Запись удалена');
    }

    /**
    * Создает или обновляет записи о предмете (в базе)
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  bool $update - Если эта переменная = true, то происходит обновление данных
    * @param  int  $id
    *
    * @return string возвращает сообщение
    */
     protected function create_or_update_item(Request  $request, $update = false, $id = -1)
    {

        // гораздо проще пересоздавать параметры элемента, да и проверки делать не нужно
        if ($update)
        {
            Galery::where('item_id', $id)->delete();
            Parameter::where('item_id', $id)->delete();
        }

        // то были новые картинки, теперь допишу старые картинки.
        if($update &&  $request->input('old_images', false))
        {
            $paths = $request->input('old_images');

            foreach ($paths as $path)
            {
                $this->add_new_image_for_galery($id, $path);
            }
        }
    }

    /**
    * Функция для сохранения картинок для галереи товара в БД. Создает непосредственно записи в БД.
    *
    * @param id id товара в базе.
    * @param file_path файловый путь к картинке
    */
    protected function add_new_image_for_galery($id, $file_path)
    {
        $g = new Galery();
        $g->item_id = $id;
        $g->image = $file_path;
        $g->save();
    }
}
