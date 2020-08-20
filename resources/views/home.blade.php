@extends('layout.app')

@section('style')
    <style>
        table tr td {
            font-size: 14px;
        }
    </style>
@endsection

@section('import_style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('content')
    
    <div class="page-header">
    <div class="page-header-title">
    <h4>{{ $titulo_page }}</h4>
    </div>
    <div class="page-header-breadcrumb">
    <ul class="breadcrumb-title">
    <li class="breadcrumb-item">
    <a href="{{ route('home') }}">
    <i class="icofont icofont-home"></i>
    </a>
    </li>
    </ul>
    </div>
    </div>
    <div class="page-body">
    <div class="row">
    <div class="col-sm-12">
    <div class="card">
    <div class="card-header">
        <div class="d-inline-flex">
            <h5>Hello card</h5>
        </div>
        <div class="float-right">
            <button id="btn_add" name="btn_add" class="btn btn-success btn-sm" style="margin-right: 100px;"><i class="zmdi zmdi-plus"></i> Novo Pedido</button>
        </div>
        <div class="card-header-right">
        <i class="icofont icofont-rounded-down"></i>
        <i class="icofont icofont-refresh"></i>
        <i class="icofont icofont-close-circled"></i>
        </div>
        </div>
    <div class="card-block">

        <div class="dt-responsive table-responsive">
            <table id="order-table" class="table table-striped table-bordered nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Origem</th>
                        <th>Pnto de venda</th>
                        <th>Status</th>
                        <th>Data</th>
                        <th>Total Pedido</th>
                        <th>Total Produto</th>
                        <th>Total Frete</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="orders-list">

                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Origem</th>
                        <th>Ponto de venda</th>
                        <th>Status</th>
                        <th>Data</th>
                        <th>Total Pedido</th>
                        <th>Total Produto</th>
                        <th>Total Frete</th>
                        <th>Ações</th>
                    </tr>
                </tfoot>
            </table>
        </div>

    {{-- <p>
    "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
    </p> --}}
    </div>
    </div>
    </div>
    </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Gerenciar Pedido</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form id="frmOrders" name="frmOrders" novalidate="">
                        <div class="form-group">
                            <input type="hidden" id="id_order" name="id_order">
                            <label for="inputName" class="control-label">Código do pedido</label>
                            <input type="text" class="form-control has-error" id="id_order" name="id_order" value="">
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="control-label">Origen</label>
                            <input type="text" class="form-control has-error" id="name" name="name" value="">
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="control-label">Ponto de venda</label>
                            <input type="text" class="form-control has-error" id="point_sale" name="point_sale" value="">
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="control-label">Status</label>
                            <input type="text" class="form-control has-error" id="status" name="status" value="">
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="control-label">Data</label>
                            <input type="text" class="form-control has-error" id="date" name="date" value="">
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="control-label">Total do pedido</label>
                            <input type="text" class="form-control has-error" id="total" name="total" value="">
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="control-label">Total do produto</label>
                            <input type="text" class="form-control has-error" id="partial_total" name="partial_total" value="">
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="control-label">Total do frete</label>
                            <input type="text" class="form-control has-error" id="shipment_value" name="shipment_value" value="">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="add"><i class="fa fa-send"></i> Cadastrar</button>
                </div>
            </div>
        </div>
    </div>
    <meta name="_token" content="{!! csrf_token() !!}" />
    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title bold uppercase" id="myModalLabel"> Confirmar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                    <strong>Você realmente deseja excluir o registro?</strong>
                </div>

                <div class="modal-footer">
                    <form method="post" action="{{ route('delete.order') }}" class="form-inline">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id_order" class="confirm_id" value="0">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('import_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    {{-- <script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>
@endsection

@section('scripts')
    <script>
        $(function(){
            get_orders();
        });

        var url = '{{ URL::to('/order') }}';

        function get_orders() {
            $.ajax({
                type:'GET',
                contentType: "application/json;charset=utf-8",
                url: "{!! URL::to('/orders') !!}",//Definindo o arquivo onde serão buscados os dados
                //dataType: "json",
                data: {},
                success: function(data){
                    //console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        //console.log(data[i]['point_sale']);
                        var list = '<tr id="order'+ data[i].id_order +'"><td>'+data[i].id_order+'</td>'+
                                    '<td>'+data[i].name+'</td><td>'+data[i].point_sale+'</td>'+
                                    '<td>'+data[i].status+'</td><td>'+data[i].date+'</td>'+
                                    '<td>'+data[i].total+'</td><td>'+data[i].partial_total+'</td>'+
                                    '<td>'+data[i].shipment_value+'</td>'+
                                    '<td><button class="btn btn-info btn-sm open_modal mr-2" data-toggle="modal" value="' + data[i].id_order + '"><i class="icofont icofont-pencil-alt-2"></i></button>'+
                                    '<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#DelModal" data-id="' + data[i].id_order + '"><i class="icofont icofont-trash"></i></button></td></tr>';
                        $('#orders-list').append(list);
                    }
                },
                error: function(data)
                {
                    $.each( data.responseJSON.errors, function( key, value ) {
                        console.error( value);
                    });
                }
            });
        }

        $('#btn_add').click(function(){
            $('#btn-save').val("add");
            $('#frmOrders').trigger("reset");
            $('#myModal').modal('show');
        });

        $(document).on('click','.open_modal',function(){
            var id_order = $(this).val();

            $.get(url + '/' + id_order, function (data) {
                //success data
                console.log(status);
                $('#id_order').val(data.id_order);
                $('#name').val(data.name);
                $('#point_sale').val(data.point_sale);
                $('#status').val(data.status);
                $('#date').val(data.date);
                $('#total').val(data.total);
                $('#partial_total').val(data.partial_total);
                $('#shipment_value').val(data.shipment_value);
                $('#btn-save').val("update").text("Salvar");
                $('#myModal').modal('show');
            })
        });

        //create new category / update existing category
        $("#btn-save").click(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            })
            e.preventDefault();
            var formData = {
                id_order: $('#id_order').val(),
                name: $('#name').val(),
                point_sale: $('#point_sale').val(),
                status: $('#status').val(),
                date: $('#date').val(),
                total: $('#total').val(),
                partial_total: $('#partial_total').val(),
                shipment_value: $('#shipment_value').val()
            }
            //used to determine the http verb to use [add=POST], [update=PUT]
            var state = $('#btn-save').val();
            var type = "POST"; //for creating new resource
            var id_order = $('#id_order').val();
            var api_url = "{!! URL::to('/order-store') !!}";
            if (state == "update"){
                type = "PUT"; //for updating existing resource
                api_url += '/' + id_order;
            }
            console.log(formData);
            $.ajax({
                type: type,
                url: api_url,
                data: formData,
                dataType: 'json',
                success: function (data) {

                    var list = '<tr id="order'+ data[i].id_order +'"><td>'+data[i].id_order+'</td>'+
                                    '<td>'+data[i].name+'</td><td>'+data[i].point_sale+'</td>'+
                                    '<td>'+data[i].status+'</td><td>'+data[i].date+'</td>'+
                                    '<td>'+data[i].total+'</td><td>'+data[i].partial_total+'</td>'+
                                    '<td>'+data[i].shipment_value+'</td>'+
                                    '<td><a href="#" class="open_modal mr-2" data-id="' + data[i].id_order + '"><i class="icofont icofont-search"></i></a>'+
                                    '<a href="javascript:void(0);" class="open_modal mr-2" data-toggle="modal" data-target="#open_modal" data-id="' + data[i].id_order + '"><i class="icofont icofont-pencil-alt-2"></i></a>'+
                                    '<a href="#" data-toggle="modal" data-target="#DelModal" data-id="' + data[i].id_order + '"><i class="icofont icofont-trash"></i></a></td></tr>';
                    
                    if (state == "add"){ //if user added a new record
                        $('#orders-list').append(list);
                    }else{ //if user updated an existing record
                        $("#order" + id_order).replaceWith( list );
                    }
                    $('#frmOrders').trigger("reset");
                    $('#myModal').modal('hide')
                },
                error: function(data)
                {
                    $.each( data.responseJSON.errors, function( key, value ) {
                        toastr.error( value);
                    });
                }
            }).done(function() {
                toastr.success('Successfully Category Saved.');
            });
        });
    </script>
    
@endsection