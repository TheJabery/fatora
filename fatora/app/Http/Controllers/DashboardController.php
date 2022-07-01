<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\fatora;


class DashboardController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

//=================احصائية نسبة تنفيذ الحالات======================



      $count_all =fatora::count();
      $count_invoices0 = fatora::where('status_value', 0)->count();
      $count_invoices1 = fatora::where('status_value', 1)->count();
      $count_invoices2 = fatora::where('status_value', 2)->count();

      if($count_invoices1 == 0){
          $nspainvoices1=0;
      }
      else{
          $nspainvoices1 = $count_invoices1/ $count_all*100;
      }

        if($count_invoices0 == 0){
            $nspainvoices0=0;
        }
        else{
            $nspainvoices0 = $count_invoices0/ $count_all*100;
        }

        if($count_invoices2 == 0){
            $nspainvoices2=0;
        }
        else{
            $nspainvoices2 = $count_invoices2/ $count_all*100;
        }


        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels([' Invoices Percentage'])
            ->datasets([
                [
                    "label" => "Unpaid Invoices",
                    'backgroundColor' => ['rgba(255, 99, 132, 0.5)'],
                    'data' => [round($nspainvoices0,2)]
                ],
                [
                    "label" => "Paid Invoices",
                    'backgroundColor' => ['rgba(54, 162, 235, 0.5)'],
                    'data' => [round($nspainvoices1,2)]
                ],
                [
                    "label" => "Partially Paid Invoices",
                    'backgroundColor' => ['rgba(250, 183, 0, 0.5)'],
                    'data' => [round($nspainvoices2,2)]
                ],


            ])
            ->options([]);


        $chartjs_2 = app()->chartjs
            ->name('pieChartTest')
            ->type('doughnut')
            ->size(['width' => 340, 'height' => 200])
            ->labels([' Unpaid Invoices ', 'Paid Invoices ','  Partially Paid Invoices'])
            ->datasets([
                [
                    'backgroundColor' => ['rgba(255, 99, 132, 0.7)', 'rgba(54, 162, 235, 0.7)','rgba(250, 183, 0, 0.7)'],
                    'data' => [round($nspainvoices0,2), Round($nspainvoices1,2),round($nspainvoices2,2)]
                ]
            ])
            ->options([]);

        return view('dashboard', compact('chartjs','chartjs_2'));


    }

}
