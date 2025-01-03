<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Isi :attribute harus diterima.',
    'active_url'           => 'Isi :attribute bukan URL yang sah.',
    'after'                => 'Isi :attribute harus tanggal setelah :date.',
    'after_or_equal'       => 'Isi :attribute harus tanggal setelah atau sama dengan :date.',
    'alpha'                => 'Isi :attribute hanya boleh berisi huruf.',
    'alpha_dash'           => 'Isi :attribute hanya boleh berisi huruf, angka, dan strip.',
    'alpha_num'            => 'Isi :attribute hanya boleh berisi huruf dan angka.',
    'array'                => 'Isi :attribute harus berupa sebuah array.',
    'before'               => 'Isi :attribute harus tanggal sebelum :date.',
    'before_or_equal'      => 'Isi :attribute harus tanggal sebelum atau sama dengan :date.',
    'between'              => [
        'numeric' => 'Isi :attribute harus antara :min dan :max.',
        'file'    => 'Isi :attribute harus antara :min dan :max kilobytes.',
        'string'  => 'Isi :attribute harus antara :min dan :max karakter.',
        'array'   => 'Isi :attribute harus antara :min dan :max item.',
    ],
    'boolean'              => 'Isi :attribute harus berupa true atau false',
    'confirmed'            => 'Konfirmasi :attribute tidak cocok.',
    'date'                 => 'Isi :attribute bukan tanggal yang valid.',
    'date_equals'          => 'Isi :attribute harus tanggal yang sama dengan :date.',
    'date_format'          => 'Isi :attribute tidak cocok dengan format :format.',
    'different'            => 'Isi :attribute dan :other harus berbeda.',
    'digits'               => 'Isi :attribute harus berupa angka :digits.',
    'digits_between'       => 'Isi :attribute harus antara angka :min dan :max.',
    'dimensions'           => 'Isi :attribute harus merupakan dimensi gambar yang sah.',
    'distinct'             => 'Isi :attribute memiliki nilai yang duplikat.',
    'email'                => 'Isi :attribute harus berupa alamat surel yang valid.',
    'ends_with'            => 'Isi :attribute harus diakhiri dengan: :values.',
    'exists'               => 'Isi :attribute yang dipilih tidak valid.',
    'file'                 => 'Isi :attribute harus berupa file.',
    'filled'               => 'Isi :attribute wajib diisi.',
    'gt' => [
        'numeric'   => 'Isi :attribute harus lebih besar dari :value.',
        'file'      => 'Isi :attribute harus lebih besar dari :value kilobytes.',
        'string'    => 'Isi :attribute harus lebih besar dari :value karakter.',
        'array'     => 'Isi :attribute harus memiliki lebih dari :value item.',
    ],
    'gte' => [
        'numeric'   => 'Isi :attribute harus lebih besar dari atau sama dengan :value.',
        'file'      => 'Isi :attribute harus lebih besar dari atau sama dengan :value kilobytes.',
        'string'    => 'Isi :attribute harus lebih besar dari atau sama dengan :value karakter.',
        'array'     => 'Isi :attribute harus memiliki :value item atau lebih.',
    ],
    'image'                => 'Isi :attribute harus berupa gambar.',
    'in'                   => 'Isi :attribute yang dipilih tidak valid.',
    'in_array'             => 'Isi :attribute tidak terdapat dalam :other.',
    'integer'              => 'Isi :attribute harus merupakan bilangan bulat.',
    'ip'                   => 'Isi :attribute harus berupa alamat IP yang valid.',
    'ipv4'                 => 'Isi :attribute harus berupa alamat IPv4 yang valid.',
    'ipv6'                 => 'Isi :attribute harus berupa alamat IPv6 yang valid.',
    'json'                 => 'Isi :attribute harus berupa JSON string yang valid.',
    'lt' => [
        'numeric'   => 'Isi :attribute harus kurang dari :value.',
        'file'      => 'Isi :attribute harus kurang dari :value kilobytes.',
        'string'    => 'Isi :attribute harus kurang dari :value karakter.',
        'array'     => 'Isi :attribute harus memiliki kurang dari :value item.',
    ],
    'lte' => [
        'numeric'   => 'Isi :attribute harus kurang dari atau sama dengan :value.',
        'file'      => 'Isi :attribute harus kurang dari atau sama dengan :value kilobytes.',
        'string'    => 'Isi :attribute harus kurang dari atau sama dengan :value karakter.',
        'array'     => 'Isi :attribute tidak boleh lebih dari :value item.',
    ],
    'max'                  => [
        'numeric' => 'Isi :attribute seharusnya tidak lebih dari :max.',
        'file'    => 'Isi :attribute seharusnya tidak lebih dari :max kilobytes.',
        'string'  => 'Isi :attribute seharusnya tidak lebih dari :max karakter.',
        'array'   => 'Isi :attribute seharusnya tidak lebih dari :max item.',
    ],
    'mimes'                => 'Isi :attribute harus dokumen berjenis : :values.',
    'mimetypes'            => 'Isi :attribute harus berupa file bertipe: :values.',
    'min'                  => [
        'numeric' => 'Isi :attribute harus minimal :min.',
        'file'    => 'Isi :attribute harus minimal :min kilobytes.',
        'string'  => 'Isi :attribute harus minimal :min karakter.',
        'array'   => 'Isi :attribute harus minimal :min item.',
    ],
    'not_in'               => 'Isi :attribute yang dipilih tidak valid.',
    'not_regex'            => 'Isi :attribute format tidak valid.',
    'numeric'              => 'Isi :attribute harus berupa angka.',
    'password'             => 'Kata sandi tidak benar',
    'present'              => 'Isi :attribute wajib ada.',
    'regex'                => 'Format Isi :attribute tidak valid.',
    'required'             => 'Isi :attribute wajib diisi.',
    'required_if'          => 'Isi :attribute wajib diisi bila :other adalah :value.',
    'required_unless'      => 'Isi :attribute wajib diisi kecuali :other memiliki nilai :values.',
    'required_with'        => 'Isi :attribute wajib diisi bila terdapat :values.',
    'required_with_all'    => 'Isi :attribute wajib diisi bila terdapat :values.',
    'required_without'     => 'Isi :attribute wajib diisi bila tidak terdapat :values.',
    'required_without_all' => 'Isi :attribute wajib diisi bila tidak terdapat ada :values.',
    'same'                 => 'Isi :attribute dan :other harus sama.',
    'size'                 => [
        'numeric' => 'Isi :attribute harus berukuran :size.',
        'file'    => 'Isi :attribute harus berukuran :size kilobyte.',
        'string'  => 'Isi :attribute harus berukuran :size karakter.',
        'array'   => 'Isi :attribute harus mengandung :size item.',
    ],
    'starts_with'          => 'Isi :attribute harus dimulai dengan: :values.',
    'string'               => 'Isi :attribute harus berupa string.',
    'timezone'             => 'Isi :attribute harus berupa zona waktu yang valid.',
    'unique'               => 'Isi :attribute sudah ada sebelumnya.',
    'uploaded'             => 'Isi :attribute gagal mengunggah.',
    'url'                  => 'Format Isi :attribute tidak valid.',
    'uuid'                 => 'Isi :attribute harus berupa UUID yang valid.',
    "without_spaces" => "Username tidak mengandung spasi.",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    // 'custom' => [
    //     'attribute-name' => [
    //         'rule-name' => 'custom-message',
    //     ],
    // ],
    'custom' => [
        'oldpassword' => [
            'required' => 'Masukkan kata sandi Anda',
            'min' => 'Kata sandi saat ini harus memiliki minimal 8 karakter',
            'max' => 'Kata Sandi saat ini tidak boleh lebih dari 30 karakter',
        ],
        'newpassword' => [
            'required' => 'Masukan kata sandi baru',
            'min' => 'Kata sandi harus memiliki minimal 8 karakter',
            'max' => 'Kata sandi tidak boleh lebih dari 30 karakter',
        ],
        'cnewpassword' => [
            'required' => 'Masukkan kembali kata sandi baru Anda',
            'same' => 'Kata sandi baru dan Konfirmasi kata sandi harus cocok'
        ],
        'username' => [
            'required' => 'Username wajib diisi!',
            'accepted' => 'Username tidak mengandung spasi',
            'unique' => 'Username sudah ada sebelumnya.'
        ],
        'email' => [
            'required' => 'E-Mail Pengguna wajib diisi!',
            'unique' => 'E-Mail pengguna sudah ada sebelumnya.'
        ],
        'position_id' => [
            'required' => 'Posisi Staf wajib diisi!',
        ],
        'no_rm' => [
            'required' => 'No. Pendaftaran wajib diisi!',
        ],
        'name' => [
            'required' => 'Nama wajib diisi!',
            'unique' => 'Nama sudah digunakan.'
        ],
        'place_brithday' => [
            'required' => 'Tempat Lahir wajib diisi!',
        ],
        'date_brithday' => [
            'required' => 'Tanggal Lahir wajib diisi!',
        ],
        'phoneNumber' => [
            'required' => 'Nomor Telpon wajib diisi!',
        ],
        'marital_status' => [
            'required' => 'Status Kawin wajib diisi!',
        ],
        'graduated_id' => [
            'required' => 'Pendidikan wajib diisi!',
        ],
        'work_id' => [
            'required' => 'Pekerjaan wajib diisi!',
        ],
        'address' => [
            'required' => 'Alamat wajib diisi!',
        ],
        'work_status' => [
            'required' => 'Status Pekerjaan wajib dipilih!',
        ],
        'gender' => [
            'required' => 'Jenis Kelamin wajib dipilih!',
        ],
        'nameHusband' => [
            'required' => 'Nama Suami wajib diisi!',
        ],
        'place_brithdayHusband' => [
            'required' => 'Tempat Lahir Suami wajib diisi!',
        ],
        'date_brithdayHusband' => [
            'required' => 'Tanggal Lahir Suami wajib diisi!',
        ],
        'phoneNumberHusband' => [
            'required' => 'Nomor Telpon Suami wajib diisi!',
        ],
        'job_idHusband' => [
            'required' => 'Pekerjaan Suami wajib diisi!',
        ],
        'graduated_idHusband' => [
            'required' => 'Pendidikan Suami wajib diisi!',
        ],
        'addressHusband' => [
            'required' => 'Alamat Suami wajib diisi!',
        ],
        'id_user' => [
            'required' => 'Pekerja wajib diisi!',
        ],
        'slug' => [
            'required' => 'Isi Kolom sebelumnya, lalu tekan Tab untuk memasukkan nilai slug secara otomatis!',
        ],


        'name_edit' => [
            'required' => 'Nama wajib diisi!',
            'unique' => 'Nama sudah digunakan.'
        ],
        'place_brithday_edit' => [
            'required' => 'Tempat Lahir wajib diisi!',
        ],
        'date_brithday_edit' => [
            'required' => 'Tanggal Lahir wajib diisi!',
        ],
        'phoneNumber_edit' => [
            'required' => 'Nomor Telpon wajib diisi!',
        ],
        'gender_edit' => [
            'required' => 'Jenis Kelamin wajib dipilih!',
        ],
        'work_id_edit' => [
            'required' => 'Pekerjaan wajib diisi!',
        ],
        'graduated_id_edit' => [
            'required' => 'Pendidikan wajib diisi!',
        ],
        'address_edit' => [
            'required' => 'Alamat wajib diisi!',
        ],


        'attendance_date' => [
            'required' => 'Tanggal Kedatangan wajib diisi!',
        ],
        'menstrual_date' => [
            'required' => 'Tanggal Menstruasi Terakhir wajib diisi!',
        ],
        'weight' => [
            'required' => 'Berat Badan wajib diisi!',
        ],
        'blood_pressure' => [
            'required' => 'Tekanan Darah wajib diisi!',
        ],
        'complication' => [
            'required' => 'Komplikasi Berat wajib diisi!',
        ],
        'failure' => [
            'required' => 'Kegagalan wajib diisi!',
        ],
        'birth_control_id' => [
            'required' => 'Alat Kontrol Kelahiran wajib dipilih',
        ],
        'return_date' => [
            'required' => 'Tanggal Kunjungan Kembali wajib diisi!',
        ],
        'description' => [
            'required' => 'Keterangan wajib diisi!',
        ],
        'title' => [
            'required' => 'Judul wajib diisi!',
            'unique' => 'Judul sudah ada sebelumnya.'
        ],
        'category_id' => [
            'required' => 'Kategori wajib diisi!',
        ],
        'image' => [
            'required' => 'Gambar wajib diisi!',
            'max' => 'Gambar harus :max'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
