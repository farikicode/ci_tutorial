<?php

/*
 * ***************************************************************
 * Script : Person_qry.php
 * Version : 
 * Date : Mar 21, 2017
 * Time : 10:27:56 PM
 * Author : Pudyasto Adi W.
 * Email : mr.pudyasto@gmail.com
 * Description : 
 * ***************************************************************
 */

/**
 * Description of Person_qry
 *
 * @author pudyasto
 */
class Person_qry extends CI_Model {
    //put your code here
    
    public function submit() {
        try{
            $array = $this->input->post();
            if(empty($array['id'])){
                unset($array['id']);
                $res = $this->db->insert('person',$array);
                if($res){
                    $this->res = 'Data Tersimpan';
                    $this->state = "1";
                }else{
                    $this->res = $err->db->error();
                    $this->state = "0";
                    
                }
            }elseif(!empty($array['id']) && empty($array['stat'])){
                $this->db->where('id', $array['id']);
                $res = $this->db->update('person',$array);
                if($res){
                    $this->res = 'Data Terupdate';
                    $this->state = "1";
                }else{
                    $this->res = $err->db->error();
                    $this->state = "0";
                    
                }
            }elseif(!empty($array['id']) && !empty($array['stat'])){
                $this->db->where('id', $array['id']);
                $res = $this->db->delete('person');
                if($res){
                    $this->res = 'Data Terhapus';
                    $this->state = "1";
                }else{
                    $this->res = $err->db->error();
                    $this->state = "0";
                    
                }
            }else{
                $this->res = 'Data tidak sesuai dengan kondisi';
                $this->state = "0";
            }
        } catch (Exception $err){
            $this->res = $err->getMessage();
            $this->state = "0";
        };
        
        $arr = array(
            'status' => $this->state,
            'msg' => $this->res,
        );
        
        return json_encode($arr);
    }
    
    public function json_dgview() {
        error_reporting(-1);

        $aColumns = array('name', 'address', 'gender', 'phone', 'email', 'birthdate','id' );
	$sIndexColumn = "id";
        if(!empty($_GET['iDisplayLength'])){
            $sLimit = " LIMIT " . $_GET['iDisplayLength'];
        }
        $sTable = " (SELECT id
                        , name
                        , address
                        , gender
                        , phone
                        , email
                        , birthdate
                        FROM
                        person
                    ) AS a";
        if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
        {   
            if($_GET['iDisplayStart']>0){
                $sLimit = "OFFSET ".intval( $_GET['iDisplayStart'] )." LIMIT ".
                        intval( $_GET['iDisplayStart'] + $_GET['iDisplayLength'] );
            }
        }

        $sOrder = "";
        if ( isset( $_GET['iSortCol_0'] ) )
        {
                $sOrder = " ORDER BY  ";
                for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
                {
                        if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
                        {
                                $sOrder .= "".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]." ".
                                        ($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
                        }
                }

                $sOrder = substr_replace( $sOrder, "", -2 );
                if ( $sOrder == " ORDER BY" )
                {
                        $sOrder = "";
                }
        }
        $sWhere = "";
        
        if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
        {
		$sWhere = " Where (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			$sWhere .= "lower(".$aColumns[$i].") LIKE '%".strtolower($this->db->escape_str( $_GET['sSearch'] ))."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
        }
        
        for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {
            
            if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
            {   
                if ( $sWhere == "" )
                {
                    $sWhere = " WHERE ";
                }
                else
                {
                    $sWhere .= " AND ";
                }
                //echo $sWhere."<br>";
                $sWhere .= "lower(".$aColumns[$i].")  LIKE '%".strtolower($this->db->escape_str($_GET['sSearch_'.$i]))."%' ";    
            }
        }
        

        /*
         * SQL queries
         * Display query
         */
        $sQuery = "
                SELECT ".str_replace(" , ", " ", implode(", ", $aColumns))."
                FROM   $sTable
                $sWhere
                $sOrder
                $sLimit
                ";
        
        //echo $sQuery;
        
        $rResult = $this->db->query( $sQuery);

        $sQuery = "
                SELECT COUNT(".$sIndexColumn.") AS fs
                FROM $sTable
                $sWhere";    //SELECT FOUND_ROWS()
        
        $rResultFilterTotal = $this->db->query( $sQuery);
        $aResultFilterTotal = $rResultFilterTotal->result_array();
        $iFilteredTotal = $aResultFilterTotal[0]['fs'];

        $sQuery = "
                SELECT COUNT(".$sIndexColumn.") AS ic
                FROM $sTable
                $sWhere";
        $rResultTotal = $this->db->query( $sQuery);
        $aResultTotal = $rResultTotal->result_array();
        $iTotal = $aResultTotal[0]['ic'];

        $output = array(
                "sEcho" => intval($_GET['sEcho']),
                "iTotalRecords" => $iTotal,
                "iTotalDisplayRecords" => $iFilteredTotal,
                "aaData" => array()
        );
        
        
        foreach ( $rResult->result_array() as $aRow )
        {
                $row = array();
                for ( $i=0 ; $i<count($aColumns) ; $i++ )
                {
                    $row[] = $aRow[ $aColumns[$i] ];
                }
                $row[6] = "<a style=\"margin-bottom: 0px;\" class=\"btn btn-default btn-xs \" href=\"".site_url('person/edit/'.$aRow['id'])."\">Edit</a>";
                $row[7] = "<button style=\"margin-bottom: 0px;\" class=\"btn btn-danger btn-xs btn-deleted \" onclick=\"deleted('".$aRow['id']."');\">Hapus</button>";
		$output['aaData'][] = $row;
	}
	echo  json_encode( $output );  
    }
}
