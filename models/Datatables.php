<?php

namespace app\models;

use Yii;
use yii\db\Query;

class Datatables 
{
	protected $table = '';
	protected $column_order = array(); //set column field database for datatable orderable
	protected $column_search = array(); //set column field database for datatable searchable 
	protected $order = array('id' => 'desc'); // default order 
	protected $limit = 50;

	public function setTable($table){
   		$this->table = $table;
	}

	  public function _get_datatables_query($where = 1) 
    {
       // $className = 'app\modules\monitoreo\models\impresoras';
        //$this->db->from($this->table);
        //$model = new $className();
        //var_dump($model);
        $query =   ( new \yii\db\Query())
    				->select(['username'])
    				->from($this->table);


        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
           
             if($_POST['search']['value']) // if datatable send POST for search
             {
        //     {
                 
        //         if($i===0) // first loop
        //         {
        //             $query->where($where)

        //         }
        //         else
        //         {
        //             $this->db->or_like($item, $_POST['search']['value']);
        //         }

        //         $query->limit($this->limit)
    				// ->all();
 
        //         if(count($this->column_search) - 1 == $i) //last loop
        //             $this->db->group_end(); //close bracket
         }
         }
          //  $i++;
        }


}