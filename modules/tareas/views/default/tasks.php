<?php use yii\widgets\LinkPager; ?>
<style>
  /* CSS used here will be applied after bootstrap.css */
thead th {
background: rgba(246,246,246,1);
background: -moz-linear-gradient(top, rgba(246,246,246,1) 0%, rgba(255,255,255,1) 42%, rgba(246,246,246,1) 80%, rgba(237,237,237,1) 100%);
background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(246,246,246,1)), color-stop(42%, rgba(255,255,255,1)), color-stop(80%, rgba(246,246,246,1)), color-stop(100%, rgba(237,237,237,1)));
background: -webkit-linear-gradient(top, rgba(246,246,246,1) 0%, rgba(255,255,255,1) 42%, rgba(246,246,246,1) 80%, rgba(237,237,237,1) 100%);
background: -o-linear-gradient(top, rgba(246,246,246,1) 0%, rgba(255,255,255,1) 42%, rgba(246,246,246,1) 80%, rgba(237,237,237,1) 100%);
background: -ms-linear-gradient(top, rgba(246,246,246,1) 0%, rgba(255,255,255,1) 42%, rgba(246,246,246,1) 80%, rgba(237,237,237,1) 100%);
background: linear-gradient(to bottom, rgba(246,246,246,1) 0%, rgba(255,255,255,1) 42%, rgba(246,246,246,1) 80%, rgba(237,237,237,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f6f6f6', endColorstr='#ededed', GradientType=0 );
}
thead:first-child th {
background: rgba(255,255,255,1);
background: -moz-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 42%, rgba(246,246,246,1) 80%, rgba(237,237,237,1) 100%);
background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(255,255,255,1)), color-stop(42%, rgba(255,255,255,1)), color-stop(80%, rgba(246,246,246,1)), color-stop(100%, rgba(237,237,237,1)));
background: -webkit-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 42%, rgba(246,246,246,1) 80%, rgba(237,237,237,1) 100%);
background: -o-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 42%, rgba(246,246,246,1) 80%, rgba(237,237,237,1) 100%);
background: -ms-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 42%, rgba(246,246,246,1) 80%, rgba(237,237,237,1) 100%);
background: linear-gradient(to bottom, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 42%, rgba(246,246,246,1) 80%, rgba(237,237,237,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed', GradientType=0 );
}
thead h4 {
font-weight: 700;
  margin-bottom: 0px;
}

.past-due {
  font-weight: 600;
  color: #a94442;
}
.time-due {
 font-weight: 600;
}

.alert-warning,.alert-success{
  text-align: center;
  vertical-align: middle;
}
</style>

<div class="col-md-12">
        <div class="col-md-12">

  <!--  <?php foreach ($tasks as $task): ?>
     <?= $task->subject; ?>
   <?php endforeach ?> -->

   <table class="table table-hover" id="task-table">
       <thead>
        <tr>
          <th colspan="2"><h4>Informacion</h4></th><th>Creada</th><th>Fecha</th><th>&nbsp;</th>
          </tr>
        </thead>
         <tbody>
            <?php foreach ($tasks as $task): ?>
          <tr class="info-task">
            <td class="alert-warning task-state"  ><span class="" ><i class="fa fa-exclamation-triangle fa-2x "></i></span></td>
            <td><a href="#"><?= $task->subject; ?></a><small><br><?= $task->from_; ?></small></td>
            <td>12/11/15</td>
            <td class="past-due">12/11/15</td>
            <td style="width: 1em;"></td>
          </tr>

           <tr style="display: none;">
            <td  ></td>
            <td colspan="4">
             <div class="row">
               <div class="col-md-6" style="min-height: 100px;">
                 <br>
                  <?php 

                      if($task->body != ''){
                        echo utf8_decode(strip_tags($task->body));
                      }else{
                        echo 'Sin contenido';
                      }

                    ?>
               </div>

               <div class="col-md-6">
                <h5>Asignar tarea a </h5>
                  <?php foreach ($users as $user): ?>
                     <button data-url="index.php?r=tareas/default/asign" class="btn btn-success btn-asignar" data-userid="<?php echo $user->id; ?>" data-taskid="<?php echo $task->id; ?>"><?php echo $user->username; ?></button>
                  <?php endforeach ?>
               </div>
             </div>
            </td>

          </tr>


            <?php endforeach ?>
    
          </tbody>
</table>

<?php  
echo LinkPager::widget([
    'pagination' => $pages,
]);

?>
  
  </div>
</div>