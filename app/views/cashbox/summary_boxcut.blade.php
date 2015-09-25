@extends ('base_templates.BaseLayout')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Corte de caja</h1>
        </div>
    </div>
    <div class="row">
    <div class="col-lg-12">
        <div id ="panel" class="panel panel-default">
        <div class="panel-heading">
            <div id="options" class="row">
                <div class="col-md-4">
                    <label for="sel1">Selecciona el corte de caja:</label>
                    <select class="form-control" id="turn_users" 
                            onChange="javascript:changeSelectTurn(this);">
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="sel1">Corte de caja</label>
                    <button id="btn_close_box" type="button" class="btn btn-outline btn-primary">Cerrar caja</button>
                </div> 
                <div class="col-md-2">
                    <label for="sel1">Gasto</label>
                    <button id="modal-410139" href="#modal-container-410139" role="button" 
                            type="button" class="btn btn-outline btn-primary" data-toggle="modal">
                        Agregar gasto
                    </button>
                </div>
                <div class="col-md-2">
                    <label for="sel1">Ingreso</label>
                    <button id="modal-410139" href="#modal-container-41013" role="button" type="button" class="btn btn-outline btn-primary" data-toggle="modal">Agregar Ingreso</button>
                </div>
                <div class="col-md-2">
                    <label for="sel1">Exportar</label>
                    <button type="button" class="btn btn-outline btn-primary">Exportar a excel</button>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                   <label for="sel1">Información general del corte de caja</label>
                </div>
                <div class="panel-body">
                    <label for="sel1">Responsable de caja:</label>
                        <p id="user_admin_name">
                            USER                                                                      
                        </p>
                    <label for="sel1">Fecha de apertura:</label>
                        <p id="date_created_at">
                            00/00/0000                                            
                        </p>
                    <label for="sel1">Cerrado por:</label>
                        <p id="user_close_name">
                                USER                                                                   
                        </p>
                    <label for="sel1">Fecha de cierre:</label>
                        <p id="date_out">
                            00/00/0000                                                                   
                        </p>
                    <label for="sel1">Hora de cierre:</label>
                        <p id="time_created_at">
                            00/00/0000                                                               
                        </p>
                    <label for="sel1">Dinero retirado:</label>
                        <p id="money_withdrawn">
                            $0.00                                                               
                        </p>
                    <label for="sel1">Se dejó en caja:</label>
                        <p id="money_left">
                            $0.00                                                              
                        </p>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div id="info" class="panel panel-default">
                <div class="panel-heading">
                    <label for="sel1">Información detallada del cierre de caja</label>
                </div>
                <div id="detail" class="panel-body">
                   <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd gradeX">
                                    <td>Apertura de caja</td>
                                    <td id="money_open_box" >
                                            $0.00                                                                              
                                    </td>
                                </tr>
                                <tr class="even gradeC">
                                    <td>Venta de membresías</td>
                                    <td id="sales_membership">$0.00</td>
                                </tr>
                                 <tr class="odd gradeX">
                                    <td>Venta de casilleros</td>
                                    <td id="sales_lockers">$0.00</td>
                                </tr>
                                 <tr class="odd gradeX">
                                    <td>Venta de productos</td>
                                    <td id="sales_products">$0.00</td>
                                </tr>
                                 <tr class="odd gradeX">
                                    <td>Venta de visitas (Pago de invitados)</td>
                                    <td id="sales_visits">$0.00</td>
                                </tr>
                                 <tr class="odd gradeX">
                                    <td>Suma total de ventas</td>
                                    <td id="total_sales">$0.00</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>Adeudos y créditos</td>
                                    <td id="debits_credits">$0.00</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>Salidas</td>
                                    <td id="buys">$0.00</td>
                                </tr>                                
                                 <tr class="odd gradeX">
                                    <td>Suma total de dinero recibido</td>
                                    <td id="total_money_received">$0.00</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>Suma de ajustes de caja (Ingresos)</td>
                                    <td id="adjust_box_income">$0.00</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>Suma de gastos de caja (Egresos)</td>
                                    <td id="adjust_box_outcome">$0.00</td>
                                </tr>
                            </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                     <h3 id="money_in_box" style="margin-left:420px;" for="sel1">DINERO EN CAJA $0.00</h3>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modal-container-410139" role="dialog" 
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Agregar egreso</h4>
            </div>
            <div class="modal-body">                
                <div class="form-group">
                    <label for="description">Descripción del egreso:</label>
                    <input type="text" class="form-control" id="outcome_description" placeholder="descripción del egreso">
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad:</label>
                    <input type="text" class="form-control" id="outcome_amount" placeholder="Cantidad">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> 
                <button id="save_outcome" type="button" class="btn btn-primary">Guardar</button>
            </div>
            </div>
        </div>
    </div>    
    
    <div class="modal fade" id="modal-container-41013" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Agregar ingreso</h4>
                </div>
                <div class="modal-body">                                                       
                    <div class="form-group">
                        <label for="description">Descripción del ingreso:</label>
                        <input type="text" class="form-control" id="income_description" placeholder="descripción del ingreso">
                    </div>
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="text" class="form-control" id="income_amount" placeholder="Cantidad">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> 
                    <button id="save_income" type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>

        </div>

    </div>    
    
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {        
    
    $.ajax({
        type: 'GET',
        url: '{{ URL::to('/turn_users') }}' + '/' + 1,
        dataType: 'json',
        success: function(d) {        
            var select = $('#turn_users');
            var turns = d.boxcuts;
            for (i = 0; i < turns.length; i++)
            {
                if(turns[i].date_time_out != null)
                    select.append("<option value='"+turns[i].id+"'>"+turns[i].created_at+"</option>");
                else
                    select.append("<option value='"+turns[i].id+"'>"+turns[i].created_at+" abierto </option>");
            }
            if(turns.length > 0){
                if(turns[0].date_time_out == null)
                    $('#btn_close_box').style.visibility="block";
                else
                    $('#btn_close_box').style.visibility="hidden";
            }        
        }
    });   
    
    $('#save_outcome').on('click', function() {
        var data = {            
            description :$("#outcome_description").val(),
            amount :$("#outcome_amount").val()                      
        }; 
        id = 0;
        $.ajax({
            type: "POST",
            url: '{{ URL::to('/outcome_ms') }}' + (typeof id !== 'undefined'?('/' + id):''),
            data: data,
            success: function(data, textStatus, jqXHR) {     
                if(data.success == true){
                    window.location.reload();
                }
                else{alert(data.errors);}                        
            },
            dataType: 'json'
        });              
        window.location.reload();      
    });     
    
    $('#save_income').on('click', function() {
        var data = {            
            description :$("#income_description").val(),
            amount :$("#income_amount").val()                      
        }; 
        id = 0;
        $.ajax({
            type: "POST",
            url: '{{ URL::to('/income_ms') }}' + (typeof id !== 'undefined'?('/' + id):''),
            data: data,
            success: function(data, textStatus, jqXHR) {     
                if(data.success == true){
                    window.location.reload();
                }
                else{alert(data.errors);}                        
            },
            dataType: 'json'
        });              
        window.location.reload();      
    });         
    
    $('#btn_close_box').on('click', function() {
        if (!confirm('¿Desea cerrar el turno de caja?')) {
            return false;
        }
        $.ajax({
            type: "GET",
            url: '{{ URL::to('/close_box') }}',
            success: function(data, textStatus, jqXHR) {                        
                if(data.success == true){
                    alert("Cierre de caja realizado!");
                    window.location.reload();
                }
                else{
                    alert(data.errors);
                    window.location.reload(); 
                }                        
            },
            dataType: 'json'
        });                          
    });    
    
}); 

function changeSelectTurn(obj)
{
    var turnUserId = obj.value
    $.ajax({
        type: 'GET',
        url: '{{ URL::to('/turn_user') }}' + '/' + turnUserId,
        dataType: 'json',
        success: function(d) {
            if(d.success == true){
                $("#user_admin_name").html(d.data['info']['user_admin_name']);
                $("#date_created_at").html(d.data['info']['date_created_at']);
                $("#user_close_name").html(d.data['info']['user_close_name']);
                $("#date_out").html(d.data['info']['date_out']);
                $("#time_created_at").html(d.data['info']['time_created_at']);
                $("#money_withdrawn").html("$"+d.data['info']['money_withdrawn']);
                $("#money_left").html("$"+d.data['info']['money_left']);
                
                $("#money_open_box").html("$"+d.data['detail']['money_open_box']);
                $("#sales_membership").html("$"+d.data['detail']['sales_membership']);
                $("#sales_lockers").html("$"+d.data['detail']['sales_lockers']);
                $("#sales_products").html("$"+d.data['detail']['sales_products']);
                $("#sales_visits").html("$"+d.data['detail']['sales_visits']);
                $("#total_sales").html("$"+d.data['detail']['total_sales']);
                $("#debits_credits").html("$"+d.data['detail']['debits_credits']);
                $("#buys").html("$"+d.data['detail']['buys']);
                $("#total_money_received").html("$"+d.data['detail']['total_money_received']);
                $("#adjust_box_income").html("$"+d.data['detail']['adjust_box_income']);
                $("#adjust_box_outcome").html("$"+d.data['detail']['adjust_box_outcome']);      
                $("#money_in_box").html("DINERO EN CAJA $".d.data['detail']['money_in_box']);  
            }
            else{
                alert("fail");
            }                  
        }
    });          
    ('#btn_close_box').hide();
    ('#options').load();
    ('#info').load();
    ('#detail').load();
}
         
</script>
@stop