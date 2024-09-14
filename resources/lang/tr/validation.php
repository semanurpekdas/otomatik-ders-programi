<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Doğrulama Mesajları
    |--------------------------------------------------------------------------
    |
    | Aşağıdaki mesajlar doğrulama sırasında kullanılan varsayılan mesajlardır.
    | Bazı kuralların birden fazla versiyonu vardır, örneğin boyut kuralları.
    | Bu mesajları ihtiyacınıza göre özelleştirebilirsiniz.
    |
    */

    'accepted' => ':attribute kabul edilmelidir.',
    'active_url' => ':attribute geçerli bir URL olmalıdır.',
    'after' => ':attribute :date tarihinden sonra bir tarih olmalıdır.',
    'after_or_equal' => ':attribute :date tarihine eşit veya daha sonra bir tarih olmalıdır.',
    'alpha' => ':attribute yalnızca harflerden oluşmalıdır.',
    'alpha_dash' => ':attribute yalnızca harfler, rakamlar, tire ve alt çizgi içerebilir.',
    'alpha_num' => ':attribute yalnızca harfler ve rakamlar içerebilir.',
    'array' => ':attribute bir dizi olmalıdır.',
    'before' => ':attribute :date tarihinden önce bir tarih olmalıdır.',
    'before_or_equal' => ':attribute :date tarihine eşit veya daha önce bir tarih olmalıdır.',
    'between' => [
        'numeric' => ':attribute :min ile :max arasında olmalıdır.',
        'file' => ':attribute :min ile :max kilobayt arasında olmalıdır.',
        'string' => ':attribute :min ile :max karakter arasında olmalıdır.',
        'array' => ':attribute :min ile :max arasında öğe içermelidir.',
    ],
    'boolean' => ':attribute alanı true veya false olmalıdır.',
    'confirmed' => ':attribute tekrarı eşleşmiyor.',
    'date' => ':attribute geçerli bir tarih olmalıdır.',
    'date_equals' => ':attribute :date tarihine eşit bir tarih olmalıdır.',
    'date_format' => ':attribute :format formatına uymuyor.',
    'different' => ':attribute ve :other farklı olmalıdır.',
    'digits' => ':attribute :digits basamak olmalıdır.',
    'digits_between' => ':attribute :min ile :max basamak arasında olmalıdır.',
    'dimensions' => ':attribute geçersiz resim boyutlarına sahip.',
    'distinct' => ':attribute alanında yinelenen bir değer var.',
    'email' => ':attribute geçerli bir e-posta adresi olmalıdır.',
    'exists' => 'Seçilen :attribute geçersiz.',
    'file' => ':attribute bir dosya olmalıdır.',
    'filled' => ':attribute alanı doldurulmalıdır.',
    'gt' => [
        'numeric' => ':attribute :value değerinden büyük olmalıdır.',
        'file' => ':attribute :value kilobayttan büyük olmalıdır.',
        'string' => ':attribute :value karakterden büyük olmalıdır.',
        'array' => ':attribute :value öğeden fazla içermelidir.',
    ],
    'gte' => [
        'numeric' => ':attribute :value değerine eşit veya büyük olmalıdır.',
        'file' => ':attribute :value kilobayttan büyük veya eşit olmalıdır.',
        'string' => ':attribute :value karakterden büyük veya eşit olmalıdır.',
        'array' => ':attribute :value veya daha fazla öğe içermelidir.',
    ],
    'image' => ':attribute bir resim olmalıdır.',
    'in' => 'Seçilen :attribute geçersiz.',
    'in_array' => ':attribute alanı :other içinde mevcut değil.',
    'integer' => ':attribute bir tamsayı olmalıdır.',
    'ip' => ':attribute geçerli bir IP adresi olmalıdır.',
    'ipv4' => ':attribute geçerli bir IPv4 adresi olmalıdır.',
    'ipv6' => ':attribute geçerli bir IPv6 adresi olmalıdır.',
    'json' => ':attribute geçerli bir JSON dizesi olmalıdır.',
    'lt' => [
        'numeric' => ':attribute :value değerinden küçük olmalıdır.',
        'file' => ':attribute :value kilobayttan küçük olmalıdır.',
        'string' => ':attribute :value karakterden küçük olmalıdır.',
        'array' => ':attribute :value öğeden az içermelidir.',
    ],
    'lte' => [
        'numeric' => ':attribute :value değerine eşit veya küçük olmalıdır.',
        'file' => ':attribute :value kilobayttan küçük veya eşit olmalıdır.',
        'string' => ':attribute :value karakterden küçük veya eşit olmalıdır.',
        'array' => ':attribute :value veya daha az öğe içermelidir.',
    ],
    'max' => [
        'numeric' => ':attribute :max değerinden büyük olamaz.',
        'file' => ':attribute :max kilobayttan büyük olamaz.',
        'string' => ':attribute :max karakterden büyük olamaz.',
        'array' => ':attribute :max öğeden fazla içermemelidir.',
    ],
    'mimes' => ':attribute şu türde bir dosya olmalıdır: :values.',
    'mimetypes' => ':attribute şu türde bir dosya olmalıdır: :values.',
    'min' => [
        'numeric' => ':attribute en az :min olmalıdır.',
        'file' => ':attribute en az :min kilobayt olmalıdır.',
        'string' => ':attribute en az :min karakter olmalıdır.',
        'array' => ':attribute en az :min öğe içermelidir.',
    ],
    'not_in' => 'Seçilen :attribute geçersiz.',
    'numeric' => ':attribute bir sayı olmalıdır.',
    'present' => ':attribute alanı mevcut olmalıdır.',
    'regex' => ':attribute formatı geçersiz.',
    'required' => ':attribute alanı gereklidir.',
    'required_if' => ':attribute alanı :other :value olduğunda gereklidir.',
    'required_unless' => ':attribute alanı :other :values içinde olmadıkça gereklidir.',
    'required_with' => ':attribute alanı :values varken gereklidir.',
    'required_with_all' => ':attribute alanı :values varken gereklidir.',
    'required_without' => ':attribute alanı :values yokken gereklidir.',
    'required_without_all' => ':attribute alanı :values içinden hiçbiri yokken gereklidir.',
    'same' => ':attribute ve :other eşleşmelidir.',
    'size' => [
        'numeric' => ':attribute :size olmalıdır.',
        'file' => ':attribute :size kilobayt olmalıdır.',
        'string' => ':attribute :size karakter olmalıdır.',
        'array' => ':attribute :size öğe içermelidir.',
    ],
    'string' => ':attribute bir dize olmalıdır.',
    'timezone' => ':attribute geçerli bir zaman dilimi olmalıdır.',
    'unique' => ':attribute zaten alınmış.',
    'uploaded' => ':attribute yüklenirken hata oluştu.',
    'url' => ':attribute formatı geçersiz.',
    'uuid' => ':attribute geçerli bir UUID olmalıdır.',

    /*
    |--------------------------------------------------------------------------
    | Özel Doğrulama Mesajları
    |--------------------------------------------------------------------------
    |
    | Belirli doğrulama kuralları için özel doğrulama mesajlarını burada
    | belirtebilirsiniz. Bu, belirli bir attribute ile ilişkili özel bir
    | mesaj tanımlamanıza olanak tanır.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'özel-mesaj',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Özel Doğrulama Attribute'ları
    |--------------------------------------------------------------------------
    |
    | Aşağıdaki dil satırları, attribute yer tutucularının daha dostça
    | hale getirilmesi için kullanılır. Örneğin, "email" yerine
    | "E-Posta Adresi" olarak değiştirebilirsiniz.
    |
    */

    'attributes' => [],

];
