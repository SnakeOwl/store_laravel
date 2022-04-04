/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/admin.js ***!
  \*******************************/
$(document).ready(function () {
  //функция для кнопки "Удалить параметр"
  //удаляет поле из DOM, использую в товарах и тд.
  function delete_parent_parent_tag() {
    $(this).parent().parent().remove(); // кнопка находится в td, а удалять нужно tr
  } // функция для кнопки "Ещё"
  // копирует DOM элемент для параметров


  function add_item_param() {
    if ($("#item-param-clone") == 0) {
      console.log("Error: не удалиось найти DOM элемент для клонирования, в таблице с характеристиками товара.");
      return;
    }

    var item = $("#item-param-clone").clone().removeClass("d-none"); //клонирование строки

    item.find(".delete-parent-parent-tag").click(delete_parent_parent_tag); //бинд функции на кнопочку "удалить параметр"

    item.appendTo("#table-params > tbody"); //добавление в таблицу
  }

  function bind_buttons() {
    $("#item-param-add").click(add_item_param); // кнопка "Ещё" (для параметров)

    $(".delete-parent-parent-tag").click(delete_parent_parent_tag); // кнопки "Удалить параметр"
  }

  bind_buttons();
});
/******/ })()
;