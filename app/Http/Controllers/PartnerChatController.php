<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Message;
use App\Models\Collectedorder;
use App\Models\Partner;
use App\Models\PartnerCustomerMessage;
use App\Models\Singleorder;
use Illuminate\Http\Request;

class PartnerChatController extends Controller
{
    public function driverschat(){


        // specify drivers that has relation with this partner
        // 1- regular order
        $allorders = Collectedorder::where('partner_id', session()->get('partner_id'))
        ->whereNotNull('driver_id')
        ->orderBy('created_at', 'ASC')
        ->get();
        $allorders = $allorders->unique('driver_id');




        // 2- single orders
        $singleorders = Singleorder::where('partner_id', session()->get('partner_id'))
        ->whereNotNull('driver_id')
        ->orderBy('created_at', 'ASC')
        ->get();
        $singleorders = $singleorders->unique('driver_id');




        // get all the messages from these drivers
        $drivers = array();
        $i = 0;

        // copy drivers
        foreach ($allorders as $order) {
          
            $drivers[$i]['id'] = $order->driver['id'];
            $drivers[$i]['name'] = $order->driver['name'];
            $drivers[$i]['status'] = $order->driver['onlinestatus'];
            $drivers[$i]['pic'] = $order->driver['pic'];


            $i++;
        }
        
        foreach ($singleorders as $order) {

            $drivers[$i]['id'] = $order->driver['id'];
            $drivers[$i]['name'] = $order->driver['name'];
            $drivers[$i]['status'] = $order->driver['onlinestatus'];
            $drivers[$i]['pic'] = $order->driver['pic'];

            $i++;
        }



        // note :: since we don't have that let's just bring the messages whom drivers send
        $messages = Message::where('partner_id', session()->get('partner_id'))
        ->orderBy('created_at', 'ASC')
        ->get();


        // get partner info
        $partner = Partner::find(session()->get('partner_id'));



        // change the seeen before going to page = 0
        $seenMessages = Message::where('partner_id', session()->get('partner_id'))
        ->where('seen', 1)
        ->update([
            'seen'=> 0
        ]);


        // the current open chat
        $openchat = 0;
        
        return view('partners.chats.drivers-chat', compact('messages', 'partner', 'drivers', 'openchat'));

    }







    // add new message
    public function sendmessagedriver(Request $request)
    {
        
        // get the message + driver
        $message = $request->message;
        $driverid = $request->driverid;


        // add new message to db
        $newmessage = new Message();
        $newmessage->partner_id = session()->get('partner_id');
        $newmessage->driver_id = $driverid;

        $newmessage->type = 'sender';
        $newmessage->date = date('Y-m-d - h:i A');
        $newmessage->seen = 0;

        $newmessage->message = $message;

        // save it
        $newmessage->save();






        // ---------------------
        // repeat the same above
        // specify drivers that has relation with this partner
        // 1- regular order
        $allorders = Collectedorder::where('partner_id', session()->get('partner_id'))
        ->whereNotNull('driver_id')
        ->orderBy('created_at', 'ASC')
        ->get();
        $allorders = $allorders->unique('driver_id');




        // 2- single orders
        $singleorders = Singleorder::where('partner_id', session()->get('partner_id'))
            ->whereNotNull('driver_id')
            ->orderBy('created_at', 'ASC')
            ->get();
        $singleorders = $singleorders->unique('driver_id');




        // get all the messages from these drivers
        $drivers = array();
        $i = 0;

        // copy drivers
        foreach ($allorders as $order) {

            $drivers[$i]['id'] = $order->driver['id'];
            $drivers[$i]['name'] = $order->driver['name'];
            $drivers[$i]['status'] = $order->driver['onlinestatus'];
            $drivers[$i]['pic'] = $order->driver['pic'];


            $i++;
        }

        foreach ($singleorders as $order) {

            $drivers[$i]['id'] = $order->driver['id'];
            $drivers[$i]['name'] = $order->driver['name'];
            $drivers[$i]['status'] = $order->driver['onlinestatus'];
            $drivers[$i]['pic'] = $order->driver['pic'];

            $i++;
        }



        // note :: since we don't have that let's just bring the messages whom drivers send
        $messages = Message::where('partner_id', session()->get('partner_id'))
        ->orderBy('created_at', 'ASC')
        ->get();


        // get partner info
        $partner = Partner::find(session()->get('partner_id'));



        // change the seeen before going to page = 0
        $seenMessages = Message::where('partner_id', session()->get('partner_id'))
        ->where('seen', 1)
        ->update([
            'seen' => 0
        ]);




        // the current open chat
        $openchat = $driverid;


        return view('partners.chats.drivers-chat', compact('messages', 'partner', 'drivers', 'openchat'));



    } //end of new message



























    // ============================================================




    // customer chat
    public function customerschat(){


        // get customer of this restaurant
        $customers = Customer::where('partner_id', session()->get('partner_id'))
        ->orderBy('created_at', 'ASC')
        ->get();



        // note :: since we don't have that let's just bring the messages whom drivers send
        $messages = PartnerCustomerMessage::where('partner_id', session()->get('partner_id'))
        ->orderBy('created_at', 'ASC')
        ->get();


        // get partner info
        $partner = Partner::find(session()->get('partner_id'));



        // change the seeen before going to page = 0
        $seenMessages = PartnerCustomerMessage::where('partner_id', session()->get('partner_id'))
        ->where('seen', 1)
        ->update([
            'seen'=> 0
        ]);


        // the current open chat
        $openchat = 0;
        
        return view('partners.chats.customers-chat', compact('customers', 'messages', 'partner', 'openchat'));

    } //end of chat page










    // add new message (customer)
    public function sendmessagecustomer(Request $request)
    {
        
        // get the message + driver
        $message = $request->message;
        $customerid = $request->customerid;


        // add new message to db
        $newmessage = new PartnerCustomerMessage();
        $newmessage->partner_id = session()->get('partner_id');
        $newmessage->customer_id = $customerid;

        $newmessage->type = 'sender';
        $newmessage->date = date('Y-m-d - h:i A');
        $newmessage->seen = 0;

        $newmessage->message = $message;

        // save it
        $newmessage->save();






        // ---------------------
        // repaet all above
        // get customer of this restaurant
        $customers = Customer::where('partner_id', session()->get('partner_id'))
        ->orderBy('created_at', 'ASC')
        ->get();



        // note :: since we don't have that let's just bring the messages whom drivers send
        $messages = PartnerCustomerMessage::where('partner_id', session()->get('partner_id'))
        ->orderBy('created_at', 'ASC')
        ->get();


        // get partner info
        $partner = Partner::find(session()->get('partner_id'));



        // change the seeen before going to page = 0
        $seenMessages = PartnerCustomerMessage::where('partner_id', session()->get('partner_id'))
        ->where('seen', 1)
        ->update([
            'seen' => 0
        ]);




        // the current open chat
        $openchat = $customerid;


        return view('partners.chats.customers-chat', compact('customers', 'messages', 'partner', 'openchat'));



    } //end of new message






    
}
