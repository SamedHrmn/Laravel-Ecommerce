<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Siparis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiparisController extends Controller
{
    public function index(){
        $siparisler = Siparis::with('sepet')
            ->whereHas('sepet',function ($query){
                $query->where('kullanici_id',auth()->id());
            })
            ->orderByDesc('created_at')
            ->get();
        return view('siparisler',compact('siparisler'));
    }

    public function detay($id){
        $siparis = Siparis::with('sepet.sepet_urunler.urun')
            ->whereHas('sepet',function ($query){
                $query->where('kullanici_id',auth()->id());
            })
            ->where('siparis.id',$id)
            ->firstOrFail();
        return view('siparis',compact('siparis'));
    }
}
