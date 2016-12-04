<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\orders;
use App\Items;
use App\Parameters;


class BasketController extends Controller
{



    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if(isset($_COOKIE['basket'])) // ���������, ���� �� ������
        {
            $orders = $_COOKIE['basket'];
            $orders=json_decode($orders); //������������ ������ �� ���� � ������ � ���������
        }
        else
        {
            $orders=[];
        }
        return view('basket',['orders'=>$orders]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkout(Request $request)
    {
        if(isset($_COOKIE['basket'])) // ���������, ���� �� ������
        {
            $orders = $_COOKIE['basket'];
            $orders=json_decode($orders); //������������ ������ �� ���� � ������ � ���������
        }
        else
        {
            return redirect('/'); //���� ����� ������, �� ���������� �� ������� ��������
        }
        $ids=[]; //��� �������������� �������
        $amount=[];//���������� �������
        $total_cost=0; //����� ���� ������
        $order_id=Orders::latest()->first();//�������� ��������� �����
        empty($order_id)? $order_id=1:$order_id=$order_id->order_id+1; //������������ � ����� �������, ���������� ����� ���������� ������ �� 1

        foreach($orders as $order)
        {
            $ids[]=$order->item_id; //������� ������ �� id ���������� �������
            $amount[$order->item_id]=$order->amount; //������� ������ � ����������� ������� ������ ['id ������'=>'���������� ������']
        }

        $items=Items::whereIn('id',$ids)->get(); //�������� ��� ���������� ������ �� ����
        foreach($items as $item)
        {
            $orders=Orders::create(['item_id'=>$item->id,'price'=>$item->price,'order_id'=>$order_id,'amount'=>$amount[$item->id],'name'=>$request->name,'address'=>$request->address,'phone'=>$request->phone]);//��������� ����� � ����
            $total_cost=$total_cost+$item->price*$amount[$item->id]; //������� ����� ����� ������
        }
        setcookie('basket',''); //������� ����
        $orders=Orders::where('order_id',$orders->order_id)->get();//�������� ������, ��� ����������� �����
        return view('finish_order',['orders'=>$orders,'total'=>$total_cost]);
    }

    public function orders()
    {
        $orders=Orders::allorders();
        return view('orders',['orders'=>$orders]);
    }

}
