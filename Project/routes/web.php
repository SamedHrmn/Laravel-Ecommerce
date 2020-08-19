<?php


use Illuminate\Support\Facades\Route;



Route::get('/odeme',function (){
    return view('odeme');
});

Route::get('/siparis',function (){
    return view('siparis');
});


Route::group(['namespace'=>'FrontEnd'],function (){
    Route::get('/','AnasayfaController@index')->name('anasayfa');
    Route::get('/magaza/{slug_kategoriadi}','KategoriController@index')->name('kategori');
    Route::get('/magaza','KategoriController@magaza')->name('magaza');
    Route::get('/urun/{slug_urunadi}','UrunController@index')->name('urun');

    Route::get('/odeme','OdemeController@index')->name('odeme');
    Route::post('/odemeyap','OdemeController@odemeyap')->name('odemeyap');

    Route::group(['middleware'=>'auth'],function (){
        Route::get('/sepet','SepetController@index')->name('sepet');

        Route::get('/siparisler','SiparisController@index')->name('siparisler');
        Route::get('/siparisler/{id}','SiparisController@detay')->name('siparis');
    });

    Route::post('/ara','UrunController@ara')->name('urun_ara');
    Route::get('/ara','UrunController@ara')->name('urun_ara');

    Route::group(['prefix'=>'kullanici'],function (){
        Route::get('/oturumac','KullaniciController@giris_form')->name('kullanici.oturumac');
        Route::get('/kaydol','KullaniciController@kaydol_form')->name('kullanici.kaydol');
        Route::post('/kaydol','KullaniciController@kaydol');
        Route::post('/oturumac','KullaniciController@giris');
        Route::post('/oturumukapat','KullaniciController@oturumukapat')->name('kullanici.oturumukapat');
    });

    Route::group(['prefix'=>'sepet'],function (){
        Route::get('/','SepetController@index')->name('sepet');
        Route::post('/ekle','SepetController@ekle')->name('sepet.ekle');
        Route::delete('/kaldir/{rowid}','SepetController@kaldir')->name('sepet.kaldir');
        Route::delete('/bosalt','SepetController@bosalt')->name('sepet.bosalt');
        Route::patch('/guncelle/{rowid}','SepetController@guncelle')->name('sepet.guncelle');
    });

});


Route::group(['prefix'=>'yonetim','namespace'=>'Yonetim'],function (){
    Route::redirect('/','/yonetim/oturumac');
    Route::match(['get', 'post'],'/oturumac','KullaniciController@oturumac')->name('yonetim.oturumac');
    Route::get('/oturumukapat','KullaniciController@oturumukapat')->name('yonetim.oturumukapat');

    Route::group(['middleware'=>'yonetim'],function (){
        Route::get('/anasayfa','AnasayfaController@index')->name('yonetim.anasayfa');

        Route::group(['prefix'=>'kullanici'],function (){
            Route::match(['get','post'],'/','KullaniciController@index')->name('yonetim.kullanici');
            Route::get('/yeni','KullaniciController@form')->name('yonetim.kullanici.yeni');
            Route::get('/duzenle/{id}','KullaniciController@form')->name('yonetim.kullanici.duzenle');
            Route::post('/kaydet/{id?}','KullaniciController@kaydet')->name('yonetim.kullanici.kaydet');
            Route::get('/sil/{id}','KullaniciController@sil')->name('yonetim.kullanici.sil');
        });

        Route::group(['prefix'=>'kategori'],function (){
            Route::match(['get','post'],'/','KategoriController@index')->name('yonetim.kategori');
            Route::get('/yeni','KategoriController@form')->name('yonetim.kategori.yeni');
            Route::get('/duzenle/{id?}','KategoriController@form')->name('yonetim.kategori.duzenle');
            Route::post('/kaydet/{id?}','KategoriController@kaydet')->name('yonetim.kategori.kaydet');
            Route::get('/sil/{id}','KategoriController@sil')->name('yonetim.kategori.sil');
        });

        Route::group(['prefix'=>'urun'],function (){
            Route::match(['get','post'],'/','UrunController@index')->name('yonetim.urun');
            Route::get('/yeni','UrunController@form')->name('yonetim.urun.yeni');
            Route::get('/duzenle/{id?}','UrunController@form')->name('yonetim.urun.duzenle');
            Route::post('/kaydet/{id?}','UrunController@kaydet')->name('yonetim.urun.kaydet');
            Route::get('/sil/{id}','UrunController@sil')->name('yonetim.urun.sil');
        });

        Route::group(['prefix'=>'siparis'],function (){
            Route::match(['get','post'],'/','SiparisController@index')->name('yonetim.siparis');
            Route::get('/yeni','SiparisController@form')->name('yonetim.siparis.yeni');
            Route::get('/duzenle/{id?}','SiparisController@form')->name('yonetim.siparis.duzenle');
            Route::post('/kaydet/{id?}','SiparisController@kaydet')->name('yonetim.siparis.kaydet');
            Route::get('/sil/{id}','SiparisController@sil')->name('yonetim.siparis.sil');
        });


    });

});



