<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Parameter;
use App\Models\Galery;
use App\Models\Directory;
use Illuminate\Support\Facades\Storage;

define('IMAGES_DIRECTORY', 'images'); // папка для хранения изображений

class ItemsController extends Controller
{
    public function index()
    {
        return view('admin.items.index', [ 'items' => Item::all() ]);
    }

    public function create()
    {
        return view('admin.items.form', ['directories' => Directory::all()]);
    }

    public function store(Request $request)
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

        return redirect()->route('items.index');
    }

    public function show(Item $id)
    {
        // ['item' => Item::findOrFail($id)]
    }

    public function edit(Item $item)
    {
        return view('admin.items.form-edit', [
            'item' => $item,
            'directories' => Directory::all()
        ]);
    }

    public function update(Request $request, Item $item)
    {
        $message = "";
        $params = $request->all();

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
        $old_images = $request->input('old_images');
        if (count($current_images) != count($old_images))
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


        return redirect()->route('items.index');
    }

    public function destroy($id)
    {
        Galery::where('item_id', $id)->delete();
        Parameter::where('item_id', $id)->delete();
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
