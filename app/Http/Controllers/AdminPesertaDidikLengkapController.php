<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminPesertaDidikLengkapController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "nama_lengkap";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = false;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = false;
			$this->button_delete = false;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = true;
			$this->table = "pesdik";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Tahun Ajaran Id","name"=>"tahun_ajaran_id","join"=>"tahun_ajaran,nama"];
			$this->col[] = ["label"=>"Prodi Id","name"=>"prodi_id","join"=>"prodi,nama"];
			$this->col[] = ["label"=>"Nama Lengkap","name"=>"nama_lengkap"];
			$this->col[] = ["label"=>"Jenis Kelamin","name"=>"jenis_kelamin"];
			$this->col[] = ["label"=>"NIPD","name"=>"NIPD"];
			$this->col[] = ["label"=>"NISN","name"=>"NISN"];
			$this->col[] = ["label"=>"NIK","name"=>"NIK"];
			$this->col[] = ["label"=>"NPSN","name"=>"NPSN_sekolah_asal"];
			$this->col[] = ["label"=>"Nama Sekolah Asal","name"=>"nama_sekolah_asal"];
			$this->col[] = ["label"=>"Tempat Lahir","name"=>"tempat_lahir"];
			$this->col[] = ["label"=>"Tanggal Lahir","name"=>"tanggal_lahir"];
			$this->col[] = ["label"=>"Nopes UN","name"=>"nopes_un"];
			$this->col[] = ["label"=>"No. Ijazah","name"=>"no_ijazah"];
			$this->col[] = ["label"=>"No. SKHUN","name"=>"no_skhun"];
			$this->col[] = ["label"=>"Registrasi Akta_lahir","name"=>"registrasi_akta_lahir"];
			$this->col[] = ["label"=>"Agama","name"=>"agama"];
			$this->col[] = ["label"=>"Kewarganegaraan","name"=>"kewarganegaraan"];
			$this->col[] = ["label"=>"provinsi","name"=>"provinsi_id","join"=>"provinsi,name"];
			$this->col[] = ["label"=>"Kabupaten","name"=>"kabupaten_id","join"=>"kabupaten,name"];
			$this->col[] = ["label"=>"Kecamatan","name"=>"kecamatan_id","join"=>"kecamatan,name"];
			$this->col[] = ["label"=>"Kelurahan","name"=>"kelurahan_id","join"=>"kelurahan,name"];
			$this->col[] = ["label"=>"RT","name"=>"rt"];
			$this->col[] = ["label"=>"RW","name"=>"rw"];
			$this->col[] = ["label"=>"Alamat","name"=>"alamat"];
			$this->col[] = ["label"=>"Kode Pos","name"=>"kode_pos"];
			$this->col[] = ["label"=>"Tempat Tinggal","name"=>"tempat_tinggal"];
			$this->col[] = ["label"=>"Moda Transportasi","name"=>"moda_transportasi"];
			$this->col[] = ["label"=>"No Kks","name"=>"no_kks"];
			$this->col[] = ["label"=>"Penerima Kps","name"=>"penerima_kps"];
			$this->col[] = ["label"=>"No Kps","name"=>"no_kps"];
			$this->col[] = ["label"=>"Penerima Kip","name"=>"penerima_kip"];
			$this->col[] = ["label"=>"No Kip","name"=>"no_kip"];
			$this->col[] = ["label"=>"Nama Kip","name"=>"nama_kip"];
			$this->col[] = ["label"=>"Nama Ayah","name"=>"nama_ayah"];
			$this->col[] = ["label"=>"NIK Ayah","name"=>"NIK_ayah"];
			$this->col[] = ["label"=>"Tahun Lahir Ayah","name"=>"tahun_lahir_ayah"];
			$this->col[] = ["label"=>"Pendidikan Ayah","name"=>"pendidikan_ayah","join"=>"pendidikan,nama"];
			$this->col[] = ["label"=>"Pekerjaan Ayah","name"=>"pekerjaan_ayah","join"=>"pekerjaan,nama"];
			$this->col[] = ["label"=>"Penghasilan Ayah","name"=>"penghasilan_ayah"];
			$this->col[] = ["label"=>"Nama Ibu","name"=>"nama_ibu"];
			$this->col[] = ["label"=>"NIK Ibu","name"=>"NIK_ibu"];
			$this->col[] = ["label"=>"Tahun Lahir Ibu","name"=>"tahun_lahir_ibu"];
			$this->col[] = ["label"=>"Pendidikan Ibu","name"=>"pendidikan_ibu"];
			$this->col[] = ["label"=>"Pekerjaan Ibu","name"=>"pekerjaan_ibu"];
			$this->col[] = ["label"=>"Penghasilan Ibu","name"=>"penghasilan_ibu"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Tahun Ajaran','name'=>'tahun_ajaran_id','type'=>'select2','validation'=>'required','width'=>'col-sm-10','datatable'=>'tahun_ajaran,name'];
			$this->form[] = ['label'=>'Prodi Id','name'=>'prodi_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'tahun_ajaran,nama'];
			$this->form[] = ['label'=>'Nama Lengkap','name'=>'nama_lengkap','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Jenis Kelamin','name'=>'jenis_kelamin','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'NIPD','name'=>'NIPD','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'NISN','name'=>'NISN','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'NIK','name'=>'NIK','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'NPSN Sekolah Asal','name'=>'NPSN_sekolah_asal','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Nama Sekolah Asal','name'=>'nama_sekolah_asal','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Tempat Lahir','name'=>'tempat_lahir','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Tanggal Lahir','name'=>'tanggal_lahir','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Tahun Ajaran Id','name'=>'tahun_ajaran_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Prodi Id','name'=>'prodi_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'tahun_ajaran,nama'];
			//$this->form[] = ['label'=>'Nama Lengkap','name'=>'nama_lengkap','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'prodi,nama'];
			//$this->form[] = ['label'=>'Jenis Kelamin','name'=>'jenis_kelamin','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'NIPD','name'=>'NIPD','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'NISN','name'=>'NISN','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'NIK','name'=>'NIK','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'NPSN Sekolah Asal','name'=>'NPSN_sekolah_asal','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Nama Sekolah Asal','name'=>'nama_sekolah_asal','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Tempat Lahir','name'=>'tempat_lahir','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Tanggal Lahir','name'=>'tanggal_lahir','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
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