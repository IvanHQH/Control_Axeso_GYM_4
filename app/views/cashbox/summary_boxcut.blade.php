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
                    <!--label for="sel1">Corte de caja</label>
                    <button id="btn_close_box" type="button" class="btn btn-outline btn-primary">
                    Cerrar turno</button-->
                </div> 
                <div class="col-md-2">
                    <!--label for="sel1">Gasto</label>
                    <button id="modal-410139" href="#modal-container-410139" role="button" 
                            type="button" class="btn btn-outline btn-primary" data-toggle="modal">
                        Agregar egreso
                    </button-->
                </div>
                <div class="col-md-2">
                    <!--label for="sel1">Ingreso</label>
                    <button id="modal-410139" href="#modal-container-41013" role="button" type="button" class="btn btn-outline btn-primary" data-toggle="modal">
                        Agregar Ingreso</button-->
                </div>
                <div class="col-md-2">
                    <!--label for="sel1">Exportar</label>
                    <button type="button" class="btn btn-outline btn-primary">Exportar a excel</button-->
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
                        <p id="time_close">
                            00:00:00                                                               
                        </p>
                    <label for="sel1">Dinero retirado:</label>
                        <p id="money_withdrawn">
                            $0.00                                                               
                        </p>
                    <label for="sel1">Apertura de caja:</label>
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
                                    <td>Venta membres&iacute;as e inscripciones efectivo</td>
                                    <td id="sales_membership">$0.00</td>
                                </tr>
                                <tr class="even gradeC">
                                    <td>Venta membres&iacute;as e inscripciones electronico</td>
                                    <td id="sales_membership_bank">$0.00</td>
                                </tr>           
                                <tr class="even gradeC">
                                    <td>Abonos cr&eacute;ditos NFC</td>
                                    <td id="payments_credit_nfc">$0.00</td>
                                </tr>     
                                 <tr class="odd gradeX">
                                    <td>Venta productos efectivo</td>
                                    <td id="sales_products">$0.00</td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>Ventas productos electronico</td>
                                    <td id="payments_bank">$0.00</td>
                                </tr>   
                                 <tr class="odd gradeX">
                                    <td>Ventas de visitas Efectivo</td>
                                    <td id="sales_visits_cash">$0.00</td>
                                </tr>
                                 <tr class="odd gradeX">
                                    <td>Ventas de visitas Electronico</td>
                                    <td id="sales_visits_bank">$0.00</td>
                                </tr>
                                 <tr class="odd gradeX">
                                    <td>Suma total ventas</td>
                                    <td id="total_sales">$0.00</td>
                                </tr>
                                <!--tr class="odd gradeX">
                                    <td>Adeudos y créditos</td>
                                    <td id="debits_credits">$0.00</td>
                                </tr-->
                                <tr class="odd gradeX">
                                    <td>Egresos</td>
                                    <td id="buys">$0.00</td>
                                </tr>                                
                                <!--tr class="odd gradeX">
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
                                </tr-->
                                <tr class="odd gradeX" style="background-color: #d9edf7">
                                    <td>DINERO EN CAJA</td>
                                    <td id="money_in_box">$0.00</td>
                                </tr>                                
                            </tbody>
                    </table>
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
                    <label for="description">* Descripción del egreso:</label>
                    <input type="text" class="form-control" id="outcome_description" placeholder="descripción del egreso">
                </div>
                <div class="form-group">
                    <label for="cantidad">* Cantidad:</label>
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
                        <label for="description">* Descripción del ingreso:</label>
                        <input type="text" class="form-control" id="income_description" placeholder="descripción del ingreso">
                    </div>
                    <div class="form-group">
                        <label for="cantidad">* Cantidad</label>
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
        url: '{{ URL::to('/turn_users') }}',
        dataType: 'json',
        success: function(d) {        
            var select = $('#turn_users');
            var turns = d.boxcuts;
            select.append("<option value='-1'></option>");
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
            descripcion :$("#outcome_description").val(),
            cantidad :$("#outcome_amount").val()                      
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
                else{
                    if(data.errors == 'NO TURN'){
                        if (!confirm('¿No hay turno habilitado. ¿Desea crear un nuevo turno?'))
                                return false;   
                        $.ajax({
                            type: "POST",
                            url: '{{ URL::to('/turn_user/create') }}',
                            success: function(d, textStatus, jqXHR) {  
                                if(d.success == true){   
                                    alert('¡Turno Agregado!');     
                                    window.location.reload();
                                }
                                else{alert(d.errors);}                        
                            },
                            dataType: 'json'
                        });                         
                    }else{
                        var txt = "Errores de validación : \n";                
                        for (i = 0; i < data.errors.length; i++)
                            txt = txt+'\n'+data.errors[i];
                        alert(txt);                    
                    }                      
                }                        
            },
            dataType: 'json'
        });              
        window.location.reload();      
    });     
    
    $('#save_income').on('click', function() {
        var data = {            
            descripcion :$("#income_description").val(),
            cantidad :$("#income_amount").val()                      
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
                else{
                    if(data.errors == 'NO TURN'){
                        if (!confirm('¿No hay turno habilitado. ¿Desea crear un nuevo turno?'))
                                return false;   
                        $.ajax({
                            type: "POST",
                            url: '{{ URL::to('/turn_user/create') }}',
                            success: function(d, textStatus, jqXHR) {  
                                if(d.success == true){   
                                    alert('¡Turno Agregado!');     
                                    window.location.reload();
                                }
                                else{alert(d.errors);}                        
                            },
                            dataType: 'json'
                        });                         
                    }else{
                        var txt = "Errores de validación : \n";                
                        for (i = 0; i < data.errors.length; i++)
                            txt = txt+'\n'+data.errors[i];
                        alert(txt);                    
                    }                      
                }                        
            },
            dataType: 'json'
        });              
        window.location.reload();      
    });         
    
    $('#btn_close_box').on('click', function() {
        if(document.getElementById('turn_users').selectedIndex != 0){
            if (!confirm('¿Desea cerrar el turno de caja?'))
                return false;      
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
        }                      
    });    
    
}); 

function changeSelectTurn(obj)
{
    var turnUserId = obj.value
    if(turnUserId != -1){
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
                if(d.data['info']['time_out'] != '00:00:00')
                    $("#time_close").html(d.data['info']['time_out']);
                else
                    $("#time_close").html("");
                $("#money_withdrawn").html("$"+parseFloat(d.data['info']['money_withdrawn']).toFixed(2));
                $("#money_left").html("$"+parseFloat(d.data['info']['money_left']).toFixed(2));                
                $("#money_open_box").html("$"+parseFloat(d.data['info']['money_left']));
                $("#sales_membership").html("$"+parseFloat(d.data['detail']['sales_membership_cash']).toFixed(2));
                $("#sales_membership_bank").html("$"+parseFloat(d.data['detail']['sales_membership_bank']).toFixed(2));
                $("#payments_credit_nfc").html("$"+parseFloat(d.data['detail']['payments_nfc']).toFixed(2));
                $("#sales_products").html("$"+parseFloat(d.data['detail']['incomes_cash']).toFixed(2));
                $("#payments_bank").html("$"+parseFloat(d.data['detail']['incomes_bank']).toFixed(2));
                $("#sales_visits_cash").html("$"+parseFloat(d.data['detail']['sales_visits_cash']).toFixed(2));
                $("#sales_visits_bank").html("$"+parseFloat(d.data['detail']['sales_visits_bank']).toFixed(2));
                $("#total_sales").html("$"+parseFloat(d.data['detail']['total_sales']).toFixed(2));
                $("#buys").html("$"+parseFloat(d.data['detail']['buys']).toFixed(2));     
                $("#money_in_box").html("$"+parseFloat(d.data['detail']['money_in_box']).toFixed(2));  
                $("#money_in_box").load();
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
    }else{
        $("#user_admin_name").html("");
        $("#date_created_at").html("");
        $("#user_close_name").html("");
        $("#date_out").html("");
        $("#time_created_at").html("");
        $("#money_withdrawn").html("");
        $("#money_left").html("");
        $("#money_open_box").html("");
        $("#sales_membership").html("");
        $("#sales_products").html("");
        $("#sales_visits_cash").html("");
        $("#sales_visits_bank").html("");
        $("#total_sales").html("");
        $("#payments_bank").html("");
        $("#buys").html("");     
        $("#money_in_box").html("");  
	$("#sales_membership_bank").html("");        
	$("#payments_credit_nfc").html("");
    }
}
         
</script>
@stop