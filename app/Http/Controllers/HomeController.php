<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contestant;
use App\Models\Payment;
use Mail;
use App\Mail\ConfirmationMail;
use App\Models\Category;
use App\Models\PhotoGallery;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    //

    public function index()
    {
        return view('children');
    }

    public function redirecPage()
    {
        return Redirect::to('/gift-of-sight');
    }

    public function stripePayment(Request $request)
    {
        $email = $request->get('contestant_email');
        $exist_contestant =  Contestant::getContestant($request->get('contestant_name'),$email);
        if($exist_contestant){
            return response()->json([
                'success' => 'false',
                'errors'  => "Already registred this name and email",
            ], 400);
        }

        $request->validate([
            'contestant_email' => 'required|email'
        ]);
    
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
    
        $item_name = "Donnation ";
        $art_gallery = $request->get('artEntryCheckbox'); 
        $donations = $request->get('inlineRadioOptions'); 
        $photography = $request->get('photographyEntryCheckbox'); 
        $art_amount = (int)str_replace("$", "", $art_gallery);
        $photograpy_amount = (int)str_replace("$", "", $photography);

        $total_amount = $request->get('total_value');
        $donation_value = 0;
        if((int)str_replace("$", "", $donations) == 0){
            $donation_value = (int)str_replace("$", "", $request->get('other_value'));
        }else{
            $donation_value = (int)str_replace("$", "", $donations);

        }

        $donation= [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => 'Donation',
                ],
                'unit_amount' => (int)str_replace("$", "", $donation_value)*100,
                ],
                'quantity' => 1,
            ];

        $art_gallery= [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => 'Art Entry',
                ],
                'unit_amount' => 5*100,
                ],
                'quantity' => 1,
            ];

            
        $photography= [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => "Photography Entry",
                ],
                'unit_amount' => 5*100,
                ],
                'quantity' => 1,
        ];

            $item_array = null;
        
            if(($art_amount != 0)  && ($photograpy_amount != 0) && ($donation_value != 0 )){
                $item_array = [$donation,$photography,$art_gallery];
                
            }else{
                if($art_amount != 0 && $donation_value != 0){
                    $item_array = [$donation,$art_gallery];
                }elseif($art_amount != 0 && ($photograpy_amount != 0)){
                    $item_array = [$photography,$art_gallery];
                }elseif($photograpy_amount != 0  && $donation_value  != 0){
                    $item_array = [$donation,$photography];
                }elseif($photograpy_amount != 0){
                    $item_array = [$photography];
                }elseif($donation_value != 0){
                    $item_array = [$donation];
                }elseif($art_amount != 0){
                    $item_array = [$art_gallery];
                }
            }

        if(($art_amount != 0)  && ($photograpy_amount) != 0){
            $entry_type_id = Category::findIdByName('both_art_and_photo');
        }else{
            if($art_amount != 0){
                $entry_type_id = Category::findIdByName('art');
            }
            if($photograpy_amount != 0){
                $entry_type_id = Category::findIdByName('photo');
            }
        }


        $contestant =  Contestant::create([
            'contestant_name' => $request->get('contestant_name'),
            'contestant_email' => $email
        ]);

        if($contestant && $email){
            Mail::to($email)->send(new ConfirmationMail($contestant));
        }
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' =>  $item_array,
            'mode' => 'payment',
            'customer_email' => $email,
            'metadata' => [
                'entry_type_id' => $entry_type_id,
                'contestant_id' => $contestant->id,
                'contestant_name' => $request->get('contestant_name'),
                'contestant_email' => $email,
            ],
            'success_url' => url('/gift-of-sight').'/success?email=' . urlencode($email) ,
            'cancel_url' => url('/gift-of-sight'),
        ]);

        // if($contestant){
        //     Payment::create([
        //         'contestant_id' => $contestant->id,
        //         'session_id' => 'abcdefghij'
        //     ]);
        // }

        return response()->json(['msg'=>'Registration Successfully', 'status'=>true,'session_id' => $session->id]);
    }

    public function successfullRegistration()
    {
        return view('successfull-registration');
    }
    
    public function successRoute()
    {
        return view('successfull-registration');
    }
    
    public function cancelRoute()
    {
        return view('successfull-registration');
    }
    
    public function uploadPhotography()
    {
        return view('upload-photograpy');
    }

    public function createPhotography(Request $request)
    {
        $contestant =  Contestant::getContestant($request->get('name'),$request->get('email'));
        if($contestant){
            $payment_category_ids = Payment::getCategoryIds($contestant->id);
            if(! $payment_category_ids->contains(3)) { //paid for both so no need to check
                if (! $payment_category_ids->contains((int)$request->get('radioOptions'))) {
                    return redirect()->back()->with('error', "Entry type you selected does not match what you paid for");
                }
            }
    
            $validator = Validator::make($request->all(), [
                'custom_file' => 'required|mimes:jpeg,png,jpg,gif,pdf',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with('error',"This type of file not uploaded.");
            }
    
            $category = (int)$request->get('radioOptions');
            $file = $request->file('custom_file');
            if($category && $file){
                $art_limit = PhotoGallery::where('contestant_id',$contestant->id)->where('category_id', $category)->get();
                if(count( $art_limit) == 5){
                    return redirect()->back()->with('error',"You have reached your limit of uploading 5 images.");
                }
    
                if ($request->hasFile('custom_file')) {
                    $image = $request->file('custom_file');
                    $name = time().'.'.$image->extension();
                    $folder = '/upload/gallery/';
                    if (!is_dir(public_path($folder))) { mkdir(public_path($folder), 0777, true); }
                    $image->move(public_path($folder), $name);
                    
                    PhotoGallery::create([
                        'contestant_id' => $contestant->id,
                        'category_id' => $category,
                        'file_name' => $name,
                        'file_source'=>$folder
                    ]);
                    return redirect()->route('home-page','#file_upload_from')->with('message',"Successfully Uploaded");
                }
            }else{
                return redirect()->route('home-page','#file_upload_from')->with('error',"You must enter your email address, specify category and choose a file to upload.");
            }
        }else{
            return redirect()->route('home-page','#file_upload_from')->with('error',"This email not in record");
        }

    }

    public function stripe_payment_webhook() {
        // Set your secret key. Remember to switch to your live secret key in production!
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        // You can find your endpoint's secret in your webhook settings
        $endpoint_secret = config('services.stripe.secret_webhook');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch(\UnexpectedValueException $e) {
            logger('stripe payment webhook processing failed - invalid payload');
            // Invalid payload
            http_response_code(400);
            exit();
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            logger('stripe payment webhook processing failed - invalid signature');
            // Invalid signature
            http_response_code(400);
            exit();
        }

        // Handle the checkout.session.completed event
        if ($event->type == 'checkout.session.completed') {
            $session = $event->data->object;

            // Fulfill the purchase...
            $this->handle_stripe_payment_completed($session);
        }

        http_response_code(200);        
    }

    public function handle_stripe_payment_completed($session) {
        if (!$session->customer || !$session->payment_intent) {
            logger('stripe payment webhook processing failed - payload does not have customer or payment_intent');
        } else {
            try {
                $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

                $customer = $stripe->customers->retrieve($session->customer, []);
                $payment_intent = $stripe->paymentIntents->retrieve($session->payment_intent, []); 
                
                if ($payment_intent->status === Payment::STRIPE_PAYMENT_SUCCESS_STATUS) {
                    $paymentM = new Payment();
                    $paymentM->session_id = $session->id;
                    $paymentM->contestant_id = $session->metadata->contestant_id;
                    $paymentM->category_id = $session->metadata->entry_type_id;
                    
                    $paymentM->webhook_payload = $session;
                    $paymentM->webhook_payload_customer = $customer;
                    $paymentM->webhook_payload_payment_intent = $payment_intent;

                    $paymentM->stripe_customer_email = $customer->email;
                    $paymentM->stripe_payment_status = $payment_intent->status;
    
                    $paymentM->save();
                    echo 'successfully saved in DB';
                } else {
                    logger('stripe payment webhook processing failed - payment does not seem to have successed, status found: ' . $payment_intent->status);
                }
            } catch (\Exception $e) {
                logger('stripe payment webhook processing failed - Stripe customer fetch or payment fetch or saving payload to DB failed, error: ' . $e->getMessage());
            }

 
        }

    }
    

    public function checkPaymentStatus(Request $request)
    {
        $contestant =  Contestant::getContestant($request->get('contestent_name'),$request->get('contestent_email')); 
        if($contestant){
            if(Payment::cheackPaidStatus($contestant->id)){
                return Payment::getCategoryCount($contestant->id);
            }
        }

    }

    public function entitySubmissionValidity(Request $request)
    {
        $contestent =  Contestant::getContestant($request->get('contestant_name'),$request->get('contestent_email')); 
        if($contestent){
            $entity_count = PhotoGallery::where('contestant_id',$contestent->id)->where('category_id',$request->get('category_value'))->get();
            return $entity_count->count();
        }
    }


}
