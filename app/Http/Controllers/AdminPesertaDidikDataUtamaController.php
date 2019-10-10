<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminPesertaDidikDataUtamaController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "nama_lengkap";
			$this->limit = "20";
			$this->orderby = "tahun_ajaran_id,desc";
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
			$this->button_import = false;
			$this->button_export = true;
			$this->table = "pesdik";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Nama Lengkap","name"=>"nama_lengkap"];
			$this->col[] = ["label"=>"JK","name"=>"jenis_kelamin"];
			$this->col[] = ["label"=>"Angkatan","name"=>"tahun_ajaran_id","join"=>"tahun_ajaran,nama"];
			$this->col[] = ["label"=>"Prodi","name"=>"prodi_id","join"=>"prodi,singkatan"];
			$this->col[] = ["label"=>"NIPD","name"=>"NIPD"];
			$this->col[] = ["label"=>"NISN","name"=>"NISN"];
			$this->col[] = ["label"=>"NIK","name"=>"NIK"];
			$this->col[] = ["label"=>"PIP","name"=>"penerima_kip"];
			// $this->col[] = ["label"=>"Tgl Lahir","name"=>"tanggal_lahir"];
			$this->col[] = ["label"=>"Status","name"=>"status_pesdik_id","join"=>"status_pesdik,nama"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Status Peserta Didik','name'=>'status_pesdik_id','type'=>'select2','validation'=>'required','width'=>'col-sm-3','datatable'=>'status_pesdik,nama'];
			$this->form[] = ['label'=>'Pas Foto','name'=>'foto','type'=>'upload','validation'=>'image|max:1000','width'=>'col-sm-5'];
			$this->form[] = ['label'=>'Nama Lengkap','name'=>'nama_lengkap','type'=>'text','validation'=>'required','width'=>'col-sm-7'];
			$this->form[] = ['label'=>'Jenis Kelamin','name'=>'jenis_kelamin','type'=>'select','validation'=>'required','width'=>'col-sm-3','dataenum'=>'Laki-laki;Perempuan'];
			$this->form[] = ['label'=>'Angkatan','name'=>'tahun_ajaran_id','type'=>'select2','validation'=>'required','width'=>'col-sm-2','datatable'=>'tahun_ajaran,nama'];
			$this->form[] = ['label'=>'Program Studi','name'=>'prodi_id','type'=>'select2','width'=>'col-sm-3','datatable'=>'prodi,nama'];
			$this->form[] = ['label'=>'NIPD','name'=>'NIPD','type'=>'number','width'=>'col-sm-3', 'validation'=>'unique:pesdik'];
			$this->form[] = ['label'=>'NISN','name'=>'NISN','type'=>'text','validation'=>'max:10','validation'=>'unique:pesdik','width'=>'col-sm-3'];
			$this->form[] = ['label'=>'NIK','name'=>'NIK','type'=>'text','validation'=>'numeric','validation'=>'unique:pesdik', 'width'=>'col-sm-4'];
			$this->form[] = ['label'=>'NPSN Sekolah Asal','name'=>'NPSN_sekolah_asal','type'=>'number','width'=>'col-sm-3'];
			$this->form[] = ['label'=>'Nama Sekolah Asal','name'=>'nama_sekolah_asal','type'=>'text','validation'=>'','width'=>'col-sm-5'];
			$this->form[] = ['label'=>'Tempat Lahir','name'=>'tempat_lahir','type'=>'text','validation'=>'required','width'=>'col-sm-5'];
			$this->form[] = ['label'=>'Tanggal Lahir','name'=>'tanggal_lahir','type'=>'date','validation'=>'required|date','width'=>'col-sm-3'];
			$this->form[] = ['label'=>'Registrasi Akta Lahir','name'=>'registrasi_akta_lahir','type'=>'text','validation'=>'','width'=>'col-sm-5'];
			$this->form[] = ['label'=>'Agama','name'=>'agama','type'=>'select','validation'=>'required','width'=>'col-sm-4','datatable'=>'agama,nama'];
			$this->form[] = ['label'=>'Kewarganegaraan','name'=>'kewarganegaraan','type'=>'select','validation'=>'required','width'=>'col-sm-4','dataenum'=>'WNI;WNA'];
			$this->form[] = ['label'=>'Kebutuhan Khusus','name'=>'kebutuhan_khusus','type'=>'select2','width'=>'col-sm-3','datatable'=>'kebutuhan_khusus,nama'];
			$this->form[] = ['label'=>'Provinsi','name'=>'provinsi_id','type'=>'select2','width'=>'col-sm-5','datatable'=>'provinsi,name'];
			$this->form[] = ['label'=>'Kabupaten/Kota','name'=>'kabupaten_id','type'=>'select','width'=>'col-sm-5','datatable'=>'kabupaten,name','parent_select'=>'provinsi_id'];
			$this->form[] = ['label'=>'Kecamatan','name'=>'kecamatan_id','type'=>'select','width'=>'col-sm-5','datatable'=>'kecamatan,name','parent_select'=>'kabupaten_id'];
			$this->form[] = ['label'=>'Kelurahan','name'=>'kelurahan_id','type'=>'select','width'=>'col-sm-5','datatable'=>'kelurahan,name','parent_select'=>'kecamatan_id'];
			$this->form[] = ['label'=>'Rt','name'=>'rt','type'=>'text','validation'=>'max:3','width'=>'col-sm-1'];
			$this->form[] = ['label'=>'Rw','name'=>'rw','type'=>'text','validation'=>'max:3','width'=>'col-sm-1'];
			$this->form[] = ['label'=>'Alamat','name'=>'alamat','type'=>'text','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Kode Pos','name'=>'kode_pos','type'=>'text','validation'=>'max:5','width'=>'col-sm-2'];
			$this->form[] = ['label'=>'Tempat Tinggal','name'=>'tempat_tinggal','type'=>'select2','width'=>'col-sm-3','datatable'=>'tempat_tinggal,nama'];
			$this->form[] = ['label'=>'Moda Transportasi','name'=>'moda_transportasi','type'=>'select2','width'=>'col-sm-3','datatable'=>'moda_transportasi,nama'];
			$this->form[] = ['label'=>'No Kks','name'=>'no_kks','type'=>'text','validation'=>'max:10','width'=>'col-sm-3','help'=>'Kosongkan Jika Bukan Penerima'];
			$this->form[] = ['label'=>'Anak Ke','name'=>'anak_ke','type'=>'text','validation'=>'max:2','width'=>'col-sm-1'];
			$this->form[] = ['label'=>'Penerima Kps','name'=>'penerima_kps','type'=>'select','validation'=>'required','width'=>'col-sm-2','dataenum'=>'Ya;Tidak'];
			$this->form[] = ['label'=>'No Kps','name'=>'no_kps','type'=>'text','validation'=>'max:10','width'=>'col-sm-3','help'=>'Kosongkan Jika Bukan Penerima'];
			$this->form[] = ['label'=>'Penerima Kip','name'=>'penerima_kip','type'=>'select','validation'=>'required','width'=>'col-sm-2','dataenum'=>'Ya;Tidak'];
			$this->form[] = ['label'=>'No. Kip/No. Rekening','name'=>'no_kip','type'=>'text','validation'=>'max:10','width'=>'col-sm-3','help'=>'Kosonkan Jika Bukan Penerima'];
			$this->form[] = ['label'=>'Nama Di Kip','name'=>'nama_kip','type'=>'text','width'=>'col-sm-4','help'=>'Alasan Jika Siswa Layak PIP'];
			$this->form[] = ['label'=>'Alasan Layak Pip','name'=>'alasan_layak_pip','type'=>'text','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Status Peserta Didik','name'=>'status_pesdik_id','type'=>'select2','validation'=>'required','width'=>'col-sm-3','datatable'=>'status_pesdik,nama'];
			//$this->form[] = ['label'=>'Pas Foto','name'=>'pas_foto','type'=>'upload','validation'=>'image|max:1000', 'width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Nama Lengkap','name'=>'nama_lengkap','type'=>'text','validation'=>'required','width'=>'col-sm-7'];
			//$this->form[] = ['label'=>'Jenis Kelamin','name'=>'jenis_kelamin','type'=>'select','validation'=>'required','width'=>'col-sm-3','dataenum'=>'Laki-laki;Perempuan'];
			//$this->form[] = ['label'=>'Angkatan','name'=>'tahun_ajaran_id','type'=>'select2','validation'=>'required','width'=>'col-sm-2','datatable'=>'tahun_ajaran,nama'];
			//$this->form[] = ['label'=>'Program Studi','name'=>'prodi_id','type'=>'select2','width'=>'col-sm-3','datatable'=>'prodi,nama'];
			//$this->form[] = ['label'=>'NIPD','name'=>'NIPD','type'=>'number','width'=>'col-sm-3'];
			//$this->form[] = ['label'=>'NISN','name'=>'NISN','type'=>'text','validation'=>'max:10','width'=>'col-sm-3'];
			//$this->form[] = ['label'=>'NIK','name'=>'NIK','type'=>'text','validation'=>'numeric','width'=>'col-sm-4'];
			//$this->form[] = ['label'=>'NPSN Sekolah Asal','name'=>'NPSN_sekolah_asal','type'=>'number','width'=>'col-sm-3'];
			//$this->form[] = ['label'=>'Nama Sekolah Asal','name'=>'nama_sekolah_asal','type'=>'text','validation'=>'required','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Tempat Lahir','name'=>'tempat_lahir','type'=>'text','validation'=>'required','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Tanggal Lahir','name'=>'tanggal_lahir','type'=>'date','validation'=>'required|date','width'=>'col-sm-3'];
			//$this->form[] = ['label'=>'Registrasi Akta Lahir','name'=>'registrasi_akta_lahir','type'=>'text','validation'=>'required','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Agama','name'=>'agama','type'=>'select','validation'=>'required','width'=>'col-sm-4','dataenum'=>'WNI;WNA','datatable'=>'agama,nama'];
			//$this->form[] = ['label'=>'Kewarganegaraan','name'=>'kewarganegaraan','type'=>'select','validation'=>'required','width'=>'col-sm-4','dataenum'=>'WNI;WNA'];
			//$this->form[] = ['label'=>'Kebutuhan Khusus','name'=>'kebutuhan_khusus','type'=>'select2','width'=>'col-sm-3','datatable'=>'kebutuhan_khusus,nama'];
			//$this->form[] = ['label'=>'Provinsi','name'=>'provinsi_id','type'=>'select2','width'=>'col-sm-5','datatable'=>'provinsi,name'];
			//$this->form[] = ['label'=>'Kabupaten/Kota','name'=>'kabupaten_id','type'=>'select','width'=>'col-sm-5','datatable'=>'kabupaten,name','parent_select'=>'provinsi_id'];
			//$this->form[] = ['label'=>'Kecamatan','name'=>'kecamatan_id','type'=>'select','width'=>'col-sm-5','datatable'=>'kecamatan,name','parent_select'=>'kabupaten_id'];
			//$this->form[] = ['label'=>'Kelurahan','name'=>'kelurahan_id','type'=>'select','width'=>'col-sm-5','datatable'=>'kelurahan,name','parent_select'=>'kecamatan_id'];
			//$this->form[] = ['label'=>'Rt','name'=>'rt','type'=>'text','validation'=>'max:3','width'=>'col-sm-1'];
			//$this->form[] = ['label'=>'Rw','name'=>'rw','type'=>'text','validation'=>'max:3','width'=>'col-sm-1'];
			//$this->form[] = ['label'=>'Alamat','name'=>'alamat','type'=>'text','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Kode Pos','name'=>'kode_pos','type'=>'text','validation'=>'required|max:5','width'=>'col-sm-2'];
			//$this->form[] = ['label'=>'Tempat Tinggal','name'=>'tempat_tinggal','type'=>'select2','width'=>'col-sm-3','datatable'=>'tempat_tinggal,nama'];
			//$this->form[] = ['label'=>'Moda Transportasi','name'=>'moda_transportasi','type'=>'select2','width'=>'col-sm-3','datatable'=>'moda_transportasi,nama','help'=>'Kosongkan Jika Bukan Penerima'];
			//$this->form[] = ['label'=>'No Kks','name'=>'no_kks','type'=>'text','validation'=>'max:10','width'=>'col-sm-3'];
			//$this->form[] = ['label'=>'Anak Ke','name'=>'anak_ke','type'=>'text','validation'=>'max:2','width'=>'col-sm-1','help'=>'Kosongkan Jika Bukan Penerima'];
			//$this->form[] = ['label'=>'Penerima Kps','name'=>'penerima_kps','type'=>'select','validation'=>'required','width'=>'col-sm-2','dataenum'=>'Ya;Tidak','help'=>'Kosonkan Jika Bukan Penerima'];
			//$this->form[] = ['label'=>'No Kps','name'=>'no_kps','type'=>'text','validation'=>'max:10','width'=>'col-sm-3'];
			//$this->form[] = ['label'=>'Penerima Kip','name'=>'penerima_kip','type'=>'select','validation'=>'required','width'=>'col-sm-2','dataenum'=>'Ya;Tidak','help'=>'Kosongkan Bukan Penerima'];
			//$this->form[] = ['label'=>'No Kip','name'=>'no_kip','type'=>'text','validation'=>'max:10','width'=>'col-sm-3','help'=>'Kosonkan Jika Bukan Penerima'];
			//$this->form[] = ['label'=>'Nama Di Kip','name'=>'nama_kip','type'=>'text','width'=>'col-sm-4','help'=>'Alasan Jika Siswa Layak PIP'];
			//$this->form[] = ['label'=>'Alasan Layak Pip','name'=>'alasan_layak_pip','type'=>'text','width'=>'col-sm-10'];
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
	        $this->button_selected[] = ['label'=>'Set Aktif','icon'=>'flaticon2-checkmark','name'=>'set_active'];
	        $this->button_selected[] = ['label'=>'Set Nonaktif','icon'=>'flaticon-close','name'=>'set_nonactive'];
	        $this->button_selected[] = ['label'=>'Set Lulus','icon'=>'flaticon-close','name'=>'set_lulus'];       
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
	        if($button_name == 'set_active') {
			    DB::table('pesdik')->whereIn('id',$id_selected)->update(['status_pesdik_id'=>1]);
			}elseif($button_name == 'set_nonactive'){
				DB::table('pesdik')->whereIn('id',$id_selected)->update(['status_pesdik_id'=>6]);
			}else{
				DB::table('pesdik')->whereIn('id',$id_selected)->update(['status_pesdik_id'=>3]);
			}
	            
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
	    	if($column_index == 1) { 
	    		$column_value = "<div style='text-align:left'><b>$column_value</b></div>"; 
	    	}
	    	if($column_index == 9) { 
	    		$column_value = "<div style='text-align:left'><b>$column_value</b></div>"; 
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