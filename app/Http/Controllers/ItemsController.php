<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
use App\Parameters_values;
use App\Parameters;
use App\Http\Requests;
use App\categories;
use App\orders;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;


class ItemsController extends Controller
{
    public function add()
    {
        $categories = new Categories();
        $categories = $categories->cat();

        return view('add', compact('categories'));
    }

    public function save(Request $request)
    {
        $root = $_SERVER['DOCUMENT_ROOT'] . "/images/"; //определяем папку для сохранения картинок

//Сохраняем картинки
        $f_name = $request->file('preview')->getClientOriginalName();//определяем имя файла
        $request->file('preview')->move($root, $f_name);
        $url_img = '/images/' . $f_name;

//Сохраняем каждый параметр
        $item = new Items;
        $item->title = $request->title; //название
        $item->description = $request->description;//описание
        $item->price = $request->price; // цена
        $item->categories_id = $request->category;
        $item->preview = $url_img; //ссылки на картинки
        $item->save(); // Сохраняем все в базу.
//Обратабываем массивы с параметрами и их значениями.
        $out = array_combine($request->parameter, $request->value); // массив будет такой ['5'=>'300'], 5 - это id параметра, 300 - значение параметра
//Сохраняем все параметры и значения в базу
        if (empty($out)) {
            return back();
        } //если нет ни одного параметра то просто редиректим обратно.
        foreach ($out as $param => $value) {
            $parameters = new Parameters_values;
            $parameters->parameters_id = $param;
            $parameters->items_id = $item->id;
            $parameters->value = $value;
            $parameters->save();
        }
        return back()->with('message', 'Товар сохранен');
    }

    public function edit($id)
    {
        $item = Items::find($id); //основные параметры
        $parameters = Items::parameters($id); //дополнительные параметры товара
        $parameters_all = Parameters::all(); //все параметры в базе
        if (strlen($parameters[0]->preview) > 0) //проверяем, есть ли изображения в базе
        {
            $images = explode(';', $parameters[0]->preview);//изображения товара
        } else {
            $images = [];
        }

        return view('edit', ['item' => $item, 'parameters' => $parameters, 'images' => $images, 'parameters_all' => $parameters_all]);
    }

    public function del_image(Request $request)
    {
        $src = $request->input("src");
        $item_id = $request->input("item_id");
        $item = Items::find($item_id);
        $images = explode(";", $item->preview);//преобразуем строку в массив
        $root = $_SERVER['DOCUMENT_ROOT']; //путь до картинок
        if (($key = array_search($src, $images)) >= 0) //находим ключ, значение, которого соответствует ссылке на картинку
        {
            unset($images[$key]); //удалем ссылку из массива
            if (file_exists($root . $src)) //проверяем существование файла
            {
                unlink($root . $src); //удаляем файл
            }
        }

        $url = implode(";", $images); //переделываем массив строку
        $item->preview = $url; //обновляем значение в поле preview
        $item->save(); //сохраняем изменения
        return "OK";
    }

    public function update(Request $request, $id)
    {

        $root = $_SERVER['DOCUMENT_ROOT'] . "/images/"; //определяем папку для сохранения картинок
        //Сохраняем картинки
        $url_img = []; // массив, который будет содержать ссылки на все картинки
        foreach ($request->file('preview') as $file) //обрабатываем массив с файлами
        {
            if (empty($file)) continue; // если <input type="file"... есть, но туда ничего не загруженно, то пропускаем
            $f_name = $file->getClientOriginalName();
            $url_img[] = '/images/' . $f_name; //добавляем url картинки в массив
            $file->move($root, $f_name); //перемещаем файл в папку
        }

// Сохраняем товар
        $item = Items::find($id);
        $item->title = $request->title; //название
        $item->description = $request->description;//описание
        $item->price = $request->price; // цена
        strlen($item->preview) ? $item->preview = explode(';', $item->preview) : $item->preview = []; // если в базе нет ссылок, то возвращаем пустой массив либо поулчаем массив из строк
        $item->preview = implode(';', array_merge($item->preview, $url_img));//создаем строку с ссылками;  //ссылки на картинки, добавляем ссылки к существующей строке
        $item->save(); // Сохраняем все в базу.

//Обратабываем массивы с параметрами и их значениями.
        if (is_array($request->parameter)) {
            $out = array_combine($request->parameter, $request->value); // массив будет такой ['5'=>'300'], 5 - это id параметра, 300 - значение параметра
            //Удаляем все дополнительные параметры товара и их значения
            Items::del($id);
            //Сохраняем все параметры и значения в базу
            foreach ($out as $param => $value) {
                $parameters = new Parameters_values;
                $parameters->parameters_id = $param;
                $parameters->items_id = $id;
                $parameters->value = $value;
                $parameters->save();
            }
        }
        return back()->with('message', "Товар изменен");
    }

    public function showAll()
    {
        $categories = categories::all();
        $items=Items::all();
        return view('index', ['categories' => $categories,'items'=>$items,]);
    }


    public function showGoods(Request $request)
    {
        $categories = categories::all();
        $cat =$request->categoria;
        $items=Items::where('categories_id', '=', $cat)->get();
        return view('/indexGoods',['items'=>$items, 'categories'=>$categories ]);
    }
}

