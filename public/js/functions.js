
$(document).ready(function() {

    //$('findGoods').click(function(){
    //    var button;
    //    var list;
    //    button = $(this); // ������ ������
    //    $.ajax({
    //        url: '/show',
    //        type: "POST",
    //        headers: {
    //            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    //        },
    //        success: function ($list) {
    //            button.after($list);
    //        },
    //        error: function (msg) {
    //            console.log(msg);
    //        }
    //    });
    //});





    $('.add_button').click(function () {
        var button;
        var list;
        button = $(this); // ������ ������
        $.ajax({
            url: '/get_parameters',
            type: "POST",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function ($list) {
                button.after($list);
            },
            error: function (msg) {
                console.log(msg);
            }
        });
    });

    $(document).on('click','.remove_button',function(){
        var block;
        if(confirm('Delete?'))
        {
            block=$(this).parent().parent().parent();
            block.remove();
        }
    });

    $(document).on('click','.add_parameter',function() {
        $('#myModal').modal('show');
    })




    $('.save_and_close').click(function(){
        var title=$('.parameter_modal').val();
        var unit=$('.unit_modal').val();

        $.ajax({
            url: '/save_parameters',
            method: 'POST',
            data: {title:title,unit:unit},
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(param)
            {
                $('select').append($('<option>', {value:param[0], text: param[1]+' ('+param[2]+')'}));//��������� � ������������� ������ ����� ��������
                $('#myModal').modal('hide');
            },
            error: function(msg){
                console.log(msg);
            }
        });
    });

    $('.add_images').click(function()
    {
        var all=$('input[name="preview"]');
        if(all.length==11) return; //��������� ���������� �������� 1 ������ � 10 �������������� ��������.
        var field=$('input[name="preview"]:first').clone(); // ��������� ���� preview
        $(this).after(field); //��������� ���� ����� ������

    });

    $('.del_image').click(function(){
        div=$(this).parent(); //div, ������� ��������� � �������� � ������
        src=$(this).prev().attr('src'); //������ �� ��������
        item_id=$("#item_id").val(); //id ������

        $.ajax({
            url: '/del_image',
            method: 'POST',
            data: {src:src,item_id:item_id},
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res)
            {
                div.remove(); //���� ��� ������ ��� ������ �� ������� div
            },
            error: function(msg)
            {
                console.log(msg);// ���� ������, �� ����� ���������� � �������
            }
        });

    });

    $('.buy-btn').click(function()
    {
        item_id=parseInt($(this).attr('id')); //�������� id ������
        price=parseInt($(this).parent().prev().children().html()); //�������� ���� ������ � ����������� �������� � ����� parseInt
        img=$(this).parent().parent().parent().children('img').attr('src'); //�������� ������ �� �����������, ��� �� �������� � �������
        title=$(this).parent().parent().children('h3').html(); //�������� ������
//������ ����� ������ ���� �� � ����� ��� ����� �����
        order=$.cookie('basket'); //�������� ���� � ������ basket
        !order ? order=[]: order=JSON.parse(order);
        if(order.length==0)
        {
            order.push({'item_id': item_id, 'price':price,'amount':1,'img':img,'title':title});//��������� ������ � ������� �������
        }
        else
        {
            flag=false; //����, ������� ���������, ��� ������ ������ � ������� ���
            for(var i=0; i<order.length; i++) //���������� ������ � ������� ������� ������ � �������
            {
                if(order[i].item_id==item_id)
                {
                    order[i].amount=order[i].amount+1; //���� ����� ��� � �������, �� ��������� +1 � ���������� (amount)
                    flag=true; //��������� ����, ��� ����� ����� ���� � � ��� ������ ������ �� �����
                }

            }

            if(!flag) //���� ���� ������, ������ ������ � ������� ��� � ��� ���� ��������.
            {
                order.push({'item_id': item_id, 'price':price,'amount':1,'img':img,'title':title}); //��������� � ������������� ������� ����� ������
            }
        }
        $.cookie('basket',JSON.stringify(order)); // ������������ ������ � ��������� � ������ � ��������� � ����
        count_order(); //��������� ������� ��� ����������� ���������� �������, ����� ������� ������ ����.
    });

    function count_order()
    {
        order=$.cookie('basket'); //�������� ����
        order ? order=JSON.parse(order): order=[]; //���� ����� ����, �� ���� ������������ � ������ � ���������
        count=0; // ���������� �������
        if(order.length>0)
        {
            for(var i=0; i<order.length; i++)
            {
                count=count+parseInt(order[i].amount);
            }
        }
        $('.count_order').html(count);// ���������� ���������� ������� �������.
    }
    count_order();//��������� ������� ��� �������� ��������



    $('.total').bind("change keyup", function()
    {
        value=$(this).val(); //�������� ��������� ��������
        if(value.match(/[^0-9]/g) || value<=0)//���������, ��� �������� �����, ��� ��� �� ����� ���� � �� �������������.
        {
            $(this).val('1'); //���� ������� ���� �� ����������� �� �������� ����� 1
        }
        price=$(this).parent().prev().html(); //�������� ���� ������
        $(this).parent().next().html(value*price); //������������� ����� ���� �� �����
    })


    function set_amount(item_id, amount)
    {
        order=JSON.parse($.cookie('basket')); //�������� ���� � ������������ � ������ � ���������
        for(var i=0;i<order.length; i++) //���������� ���� ������ � ���������
        {
            if(order[i].item_id=item_id) //���� ����� id
            {
                order[i].amount=amount; // ������������� ���������� ������
            }
        }
        $.cookie('basket',JSON.stringify(order)); // ��������� ��� � ����
        count_order(); //�� �������� ��������� ���������� ������� � �������
    }


    $('.total').bind("change keyup", function()
    {
        value=$(this).val(); //�������� ��������� ��������
        if(value.match(/[^0-9]/g) || value<=0)//���������, ��� �������� �����, ��� ��� �� ����� ���� � �� �������������.
        {
            $(this).val('1'); //���� ������� ���� �� ����������� �� �������� ����� 1
            value=1;
        }
        price=$(this).parent().prev().html(); //�������� ���� ������
        $(this).parent().next().html(value*price); //������������� ����� ���� �� �����
        item_id=$(this).parent().parent().children().first().html(); //�������� id ������
        set_amount(item_id,value); //��������� ����� ���������� ������ � ����
    })


    $('.plus').click(function()
    {
        current_val=$(this).prev().val();//�������� ������� �������� ���������� ������
        $(this).prev().val(+current_val+1); //��������� � �������� �������� �������
        $('.total').change(); //��������, ��� �������� ����������
    })


    $('.minus').click(function()
    {
        current_val=$(this).prev().prev().val();
        new_val=+current_val-1;
        if(new_val<=0)
        {
            new_val=1;
        }
        $(this).prev().prev().val(new_val);
        $('.total').change();
    })



    $('.del_order').click(function()
    {
        string=$(this).parent().parent();// �������� ��� ������ � �������
        item_id=$(this).parent().parent().children().first().html();//�������� id ������
        string.remove();// ������� ������
        order=JSON.parse($.cookie('basket'));//�������� ������ � ��������� �� ����
        for(var i=0;i<order.length; i++)
        {
            if(order[i].item_id==item_id)
            {
                order.splice(i,1); //������� �� ������� ������
            }
        }
        $.cookie('basket',JSON.stringify(order));//��������� ������ � ����
        count_order(); //��������� �������
        all_order=$('tr'); //�������� ��� ������ �������
        if(all_order.length<=1) {location.reload()}; //���� ��� �� ������ ������, �� ������������� ��������
    })

    function total_cost()
    {
        order=JSON.parse($.cookie('basket'));
        total=0;
        for(var i=0;i<order.length; i++)
        {
            total=total+(order[i].amount*order[i].price);
        }
        return total;
    }

    function insert_cost()
    {
        $('.total_cost').html(total_cost());
    }

    $('.total').bind("change", function()
    {
        insert_cost();
    });

    $('.buy-btn').click(function() {
        item_id = parseInt($(this).attr('id')); //�������� id ������
        price = parseInt($(this).parent().prev().children().html()); //�������� ���� ������ � ����������� �������� � ����� parseInt
        img = $(this).parent().parent().parent().children('img').attr('src'); //�������� ������ �� �����������, ��� �� �������� � �������
        title = $(this).parent().parent().children('h3').html();
    })




});