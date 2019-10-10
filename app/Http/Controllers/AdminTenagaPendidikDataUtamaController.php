<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminTenagaPendidikDataUtamaController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "nama_lengkap";
			$this->limit = "20";
			$this->orderby = "nama_lengkap,asc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = true;
			$this->button_export = true;
			$this->table = "tenpen";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"NIK","name"=>"nik"];
			$this->col[] = ["label"=>"Nama Lengkap","name"=>"nama_lengkap"];
			$this->col[] = ["label"=>"NUPTK","name"=>"nuptk"];
			$this->col[] = ["label"=>"NIP","name"=>"nip"];
			$this->col[] = ["label"=>"NIY/NIGK","name"=>"niy_nigk"];
			$this->col[] = ["label"=>"TMT","name"=>"tmt"];
			$this->col[] = ["label"=>"TST","name"=>"tst"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'NIK','name'=>'nik','type'=>'text','validation'=>'required','width'=>'col-sm-3'];
			$this->form[] = ['label'=>'NUPTK','name'=>'nuptk','type'=>'number','validation'=>'numeric','width'=>'col-sm-3'];
			$this->form[] = ['label'=>'NIP','name'=>'nip','type'=>'number','validation'=>'numeric','width'=>'col-sm-3'];
			$this->form[] = ['label'=>'NIY/NIGK','name'=>'niy_nigk','type'=>'number','validation'=>'numeric','width'=>'col-sm-4'];
			$this->form[] = ['label'=>'TMT','name'=>'tmt','type'=>'date','validation'=>'required|date','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'TST','name'=>'tst','type'=>'date','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Nama Lengkap','name'=>'nama_lengkap','type'=>'text','validation'=>'required','width'=>'col-sm-7'];
			$this->form[] = ['label'=>'Tempat Lahir','name'=>'tempat_lahir','type'=>'text','validation'=>'required','width'=>'col-sm-3'];
			$this->form[] = ['label'=>'Tanggal Lahir','name'=>'tanggal_lahir','type'=>'date','validation'=>'required|date','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Agama','name'=>'agama','type'=>'select','validation'=>'required','width'=>'col-sm-3','datatable'=>'agama,nama'];
			$this->form[] = ['label'=>'Pendidikan','name'=>'pendidikan_id','type'=>'select2','validation'=>'required','width'=>'col-sm-3','datatable'=>'pendidikan,nama'];
			$this->form[] = ['label'=>'Kewarganegaraan','name'=>'kewarganegaraan','type'=>'select','validation'=>'required','width'=>'col-sm-2','dataenum'=>'WNI;WNA'];
			$this->form[] = ['label'=>'Provinsi','name'=>'provinsi_id','type'=>'select2','width'=>'col-sm-5','datatable'=>'provinsi,name'];
			$this->form[] = ['label'=>'Kabupaten/Kota','name'=>'kabupaten_id','type'=>'select','width'=>'col-sm-5','datatable'=>'kabupaten,name','parent_select'=>'provinsi_id'];
			$this->form[] = ['label'=>'Kecamatan','name'=>'kecamatan_id','type'=>'select','width'=>'col-sm-5','datatable'=>'kecamatan,name','parent_select'=>'kabupaten_id'];
			$this->form[] = ['label'=>'Kelurahan','name'=>'kelurahan_id','type'=>'select','width'=>'col-sm-5','datatable'=>'kelurahan,name','parent_select'=>'kecamatan_id'];
			$this->form[] = ['label'=>'Alamat','name'=>'alamat','type'=>'text','validation'=>'','width'=>'col-sm-5'];
			$this->form[] = ['label'=>'Rt','name'=>'rt','type'=>'number','validation'=>'numeric','width'=>'col-sm-1'];
			$this->form[] = ['label'=>'Rw','name'=>'rw','type'=>'number','validation'=>'numeric','width'=>'col-sm-1'];
			$this->form[] = ['label'=>'No Telp','name'=>'no_telp','type'=>'number','validation'=>'numeric','width'=>'col-sm-3','placeholder'=>'Anda hanya dapat memasukkan angka saja'];
			$this->form[] = ['label'=>'Email','name'=>'email','type'=>'email','validation'=>'email|unique:tenpen','width'=>'col-sm-4','placeholder'=>'Mohon input alamat email dengan benar'];
			$this->form[] = ['label'=>'Foto','name'=>'foto','type'=>'upload','validation'=>'image|max:3000','width'=>'col-sm-4','help'=>'Tipe file yang didukung: JPG, JPEG, PNG, GIF, BMP'];
			$this->form[] = ['label'=>'Nama Ayah','name'=>'nama_ayah','type'=>'text','width'=>'col-sm-5'];
			$this->form[] = ['label'=>'Tahun Lahir Ayah','name'=>'tahun_lahir_ayah','type'=>'number','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Nama Ibu','name'=>'nama_ibu','type'=>'text','width'=>'col-sm-5'];
			$this->form[] = ['label'=>'Tahun Lahir Ibu','name'=>'tahun_lahir_ibu','type'=>'number','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Facebook','name'=>'facebook','type'=>'text','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Instagram','name'=>'instagram','type'=>'text','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Twitter','name'=>'twitter','type'=>'text','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Lampiran 1','name'=>'lampiran_1','type'=>'upload','width'=>'col-sm-5','help'=>'Contoh: Lampiran Lamarann/CV/KK/KTP & Dokumen Lainnya'];
			$this->form[] = ['label'=>'Lampiran 2','name'=>'lampiran_2','type'=>'upload','width'=>'col-sm-5','help'=>'Contoh: Lampiran Lamarann/CV/KK/KTP & Dokumen Lainnya'];
			$this->form[] = ['label'=>'Lampiran 3','name'=>'lampiran_3','type'=>'upload','width'=>'col-sm-5','help'=>'Contoh: Lampiran Lamarann/CV/KK/KTP & Dokumen Lainnya'];
			$this->form[] = ['label'=>'Lampiran 4','name'=>'lampiran_4','type'=>'upload','width'=>'col-sm-5','help'=>'Contoh: Lampiran Lamarann/CV/KK/KTP & Dokumen Lainnya'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'NIK','name'=>'nik','type'=>'text','validation'=>'required','width'=>'col-sm-3'];
			//$this->form[] = ['label'=>'NUPTK','name'=>'nuptk','type'=>'number','validation'=>'numeric','width'=>'col-sm-3'];
			//$this->form[] = ['label'=>'NIP','name'=>'nip','type'=>'number','validation'=>'numeric','width'=>'col-sm-3'];
			//$this->form[] = ['label'=>'NIY/NIGK','name'=>'niy_nigk','type'=>'number','validation'=>'numeric','width'=>'col-sm-4'];
			//$this->form[] = ['label'=>'TMT','name'=>'tmt','type'=>'date','validation'=>'required|date','width'=>'col-sm-2'];
			//$this->form[] = ['label'=>'TST','name'=>'tst','type'=>'date','width'=>'col-sm-2'];
			//$this->form[] = ['label'=>'Nama Lengkap','name'=>'nama_lengkap','type'=>'text','validation'=>'required','width'=>'col-sm-7'];
			//$this->form[] = ['label'=>'Tempat Lahir','name'=>'tempat_lahir','type'=>'text','validation'=>'required','width'=>'col-sm-3'];
			//$this->form[] = ['label'=>'Tanggal Lahir','name'=>'tanggal_lahir','type'=>'date','validation'=>'required|date','width'=>'col-sm-2'];
			//$this->form[] = ['label'=>'Agama','name'=>'agama','type'=>'select','validation'=>'required','width'=>'col-sm-3','datatable'=>'agama,nama'];
			//$this->form[] = ['label'=>'Pendidikan','name'=>'pendidikan_id','type'=>'select2','validation'=>'required','width'=>'col-sm-3','datatable'=>'pendidikan,nama'];
			//$this->form[] = ['label'=>'Kewarganegaraan','name'=>'kewarganegaraan','type'=>'select','validation'=>'required','width'=>'col-sm-2','dataenum'=>'WNI;WNA'];
			//$this->form[] = ['label'=>'Provinsi','name'=>'provinsi_id','type'=>'select2','width'=>'col-sm-5','datatable'=>'provinsi,name'];
			//$this->form[] = ['label'=>'Kabupaten/Kota','name'=>'kabupaten_id','type'=>'select','width'=>'col-sm-5','datatable'=>'kabupaten,name','parent_select'=>'provinsi_id'];
			//$this->form[] = ['label'=>'Kecamatan','name'=>'kecamatan_id','type'=>'select','width'=>'col-sm-5','datatable'=>'kecamatan,name','parent_select'=>'kabupaten_id'];
			//$this->form[] = ['label'=>'Kelurahan','name'=>'kelurahan_id','type'=>'select','width'=>'col-sm-5','datatable'=>'kelurahan,name','parent_select'=>'kecamatan_id'];
			//$this->form[] = ['label'=>'Rt','name'=>'rt','type'=>'number','validation'=>'numeric','width'=>'col-sm-1'];
			//$this->form[] = ['label'=>'Rw','name'=>'rw','type'=>'number','validation'=>'numeric','width'=>'col-sm-1'];
			//$this->form[] = ['label'=>'No Telp','name'=>'no_telp','type'=>'number','validation'=>'numeric','width'=>'col-sm-3','placeholder'=>'Anda hanya dapat memasukkan angka saja'];
			//$this->form[] = ['label'=>'Email','name'=>'email','type'=>'email','validation'=>'email|unique:tenpen','width'=>'col-sm-4','placeholder'=>'Mohon input alamat email dengan benar'];
			//$this->form[] = ['label'=>'Foto','name'=>'foto','type'=>'upload','validation'=>'image|max:3000','width'=>'col-sm-4','help'=>'Tipe file yang didukung: JPG, JPEG, PNG, GIF, BMP'];
			//$this->form[] = ['label'=>'Nama Ayah','name'=>'nama_ayah','type'=>'text','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Tahun Lahir Ayah','name'=>'tahun_lahir_ayah','type'=>'number','width'=>'col-sm-2'];
			//$this->form[] = ['label'=>'Nama Ibu','name'=>'nama_ibu','type'=>'text','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Tahun Lahir Ibu','name'=>'tahun_lahir_ibu','type'=>'number','width'=>'col-sm-2'];
			//$this->form[] = ['label'=>'Facebook','name'=>'facebook','type'=>'text','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Instagram','name'=>'instagram','type'=>'text','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Twitter','name'=>'twitter','type'=>'text','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Lampiran 1','name'=>'lampiran_1','type'=>'upload','width'=>'col-sm-5','help'=>'Contoh: Lampiran Lamarann/CV/KK/KTP & Dokumen Lainnya'];
			//$this->form[] = ['label'=>'Lampiran 2','name'=>'lampiran_2','type'=>'upload','width'=>'col-sm-5','help'=>'Contoh: Lampiran Lamarann/CV/KK/KTP & Dokumen Lainnya'];
			//$this->form[] = ['label'=>'Lampiran 3','name'=>'lampiran_3','type'=>'upload','width'=>'col-sm-5','help'=>'Contoh: Lampiran Lamarann/CV/KK/KTP & Dokumen Lainnya'];
			//$this->form[] = ['label'=>'Lampiran 4','name'=>'lampiran_4','type'=>'upload','width'=>'col-sm-5','help'=>'Contoh: Lampiran Lamarann/CV/KK/KTP & Dokumen Lainnya'];
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



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          

	        
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
	        //Your code here
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        //Your code here

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
	        //Your code here

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
	        //Your code here

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