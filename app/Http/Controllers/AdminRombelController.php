<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminRombelController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "kelas_id,desc";
			$this->orderby = "nama,asc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "rombel";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Nama Rombel","name"=>"nama"];
			$this->col[] = ["label"=>"Wali Kelas","name"=>"tenpen_id","join"=>"tenpen,nama_lengkap"];
			$this->col[] = ["label"=>"Tahun Ajaran","name"=>"tahun_ajaran_id","join"=>"tahun_ajaran,nama"];
			$this->col[] = ["label"=>"Jumlah Peserta","name"=>"(select count(pesdik_rombel.id) from pesdik_rombel where pesdik_rombel.rombel_id = rombel.id) as total_pesdik"];
			$this->col[] = ["label"=>"Kelas","name"=>"kelas_id","join"=>"kelas,nama"];
			// $this->col[] = ["label"=>"Keterangan","name"=>"keterangan"];
			$this->col[] = ["label"=>"Dibuat Pada","name"=>"created_at"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Nama Rombel','name'=>'nama','type'=>'text','validation'=>'required|max:191','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Kelas','name'=>'kelas_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-2','datatable'=>'kelas,nama'];
			$this->form[] = ['label'=>'Wali Kelas','name'=>'tenpen_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-4','datatable'=>'tenpen,nama_lengkap'];
			// $this->form[] = ['label'=>'Tahun Ajaran','name'=>'tahun_ajaran_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-2','datatable'=>'tahun_ajaran,nama'];
			$this->form[] = ['label'=>'Keterangan','name'=>'keterangan','type'=>'text','validation'=>'max:255','width'=>'col-sm-10'];

			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Kelas Id","name"=>"kelas_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"kelas,nama"];
			//$this->form[] = ["label"=>"Tenpen Id","name"=>"tenpen_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"tenpen,nama_lengkap"];
			//$this->form[] = ["label"=>"Tahun Ajaran Id","name"=>"tahun_ajaran_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"tahun_ajaran,nama"];
			//$this->form[] = ["label"=>"Keterangan","name"=>"keterangan","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			# OLD END FORM

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
	        $this->sub_module = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
	        $this->addaction = array();
	        $this->addaction[] = [
	        	'label'=>'Kelola','url'=>CRUDBooster::mainpath('kelola/[id]'),'icon'=>'flaticon-presentation','color'=>'default',
	        ];

	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
	        $this->button_selected = array();

	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
	        $this->alert        = array();  
	        // $this->alert[] = ["message"=>"<b>Pastikan untuk tidak menambah kelas dan tahun ajaran yang sama!</b>","type"=>"dark"];
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
	        $this->index_button = array();
	        $this->index_button[] = ['label'=>'Manajemen Rombel','url'=>CRUDBooster::mainpath("print"),"icon"=>"flaticon-network"];


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          
	        //$this->table_row_color[] = ['condition'=>"[kelas_id] == 4","color"=>"table-success"];
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
	        */
	        $this->index_statistic = array();



	        /*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = NULL;


            /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code after index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = NULL;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();
	        
	        
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
	        $query->where('tahun_ajaran_id',tapel_aktif()->id);
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	if($column_index == 4) { 
	    		$column_value = "<div style='text-align:center'><b>$column_value</b></div>"; 
	    	}
	    	if ($column_index == 1) {
	    		$column_value = "<div style='text-align:center'><b>$column_value</b></div>"; 
	    	}
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //$cekRombel 	= DB::table('rombel')->where('id', $id)->first();
	        $kelasID 	= $postdata['kelas_id'];
	        $tahunID 	= tapel_aktif()->id;
	        $cekRombel = DB::table('rombel')
	        				->where('kelas_id', $kelasID)
	        				->where('tahun_ajaran_id', $tahunID)
	        				->exists();
	        if($cekRombel){
	        	//DB::table('rombel')->where('id', $id)->delete();
	        	CRUDBooster::redirect(CRUDBooster::adminPath('rombel'),"Kelas & Tahun Ajaran Yang Ditambahkan Sudah Tersedia","warning");
	        }else{
	        	$postdata['tahun_ajaran_id'] = tapel_aktif()->id;
	        }
	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	    	
	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {     
	    	$dataRombel 	= DB::table('rombel')->where('id', $id)->first();
	    	$dataNamaRombel = $dataRombel->nama;
	    	$dataKeterangan = $dataRombel->keterangan;
	    	if($postdata['nama'] == $dataNamaRombel AND $postdata['keterangan'] == $dataKeterangan){
	    		$kelasID 	= $postdata['kelas_id'];
		        $tahunID 	= tapel_aktif()->id;
		        $cekRombel = DB::table('rombel')
		        				->where('kelas_id', $kelasID)
		        				->where('tahun_ajaran_id', $tahunID)
		        				->exists();
		        if($cekRombel){
		        	CRUDBooster::redirect(CRUDBooster::adminPath('rombel'),"Kelas & Tahun Ajaran Yang Diperbarui Sudah Tersedia","warning");
		        }
	    	}
	        

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	       $cekPeserta = DB::table('pesdik_rombel')->select('pesdik_id')->where('rombel_id', $id)->exists();
	       if($cekPeserta) {
	       		CRUDBooster::redirect(CRUDBooster::adminPath('rombel'),"Rombel Berisi Peserta Didik Tidak Dapat Dihapus!","danger");
	       }
	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }



	    //By the way, you can still create your own method in here... :) 


	}