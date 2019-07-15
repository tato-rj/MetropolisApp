<?php

namespace App\Http\Controllers;

use App\{Workshop, UserWorkshop};
use Illuminate\Http\Request;
use App\Events\WorkshopSignup;
use App\Services\PagSeguro\PagSeguro;
use App\Http\Requests\CreditCardForm;
use App\Http\Requests\CreateWorkshopForm;
use App\Tools\Cropper;
use Carbon\Carbon;

class WorkshopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workshops = Workshop::upcoming()->filtered()->ordered()->paginate(4);

        return view('pages.workshops.index', compact('workshops'));
    }
    
    public function payment(Workshop $workshop)
    {
        $this->authorize('signup', $workshop);

        if ($workshop->isFree) {
            auth()->user()->signup($workshop);

            event(new WorkshopSignup($workshop));

            return redirect()->route('client.workshops.index')->with('status', 'O seu pedido foi realizado com sucesso. A reserva será confirmada assim que o pagamento estiver completo.');
        }

        $pagseguro = new PagSeguro;

        return view('pages.user.checkout.workshop.index', compact(['workshop', 'pagseguro']));
    }

    public function purchase(Workshop $workshop, Request $request, CreditCardForm $form)
    {
        $this->authorize('signup', $workshop);

        $pagseguro = new PagSeguro;

        $user = auth()->user();

        $fee = $workshop->discount ? $workshop->discount : $workshop->fee;

        $fee = coupon($request->coupon, $fee);

        $reference = $pagseguro->generateReference($prefix = 'W', $user);

        $status = $pagseguro->event($user, $request, $fee)->purchase($reference);
        
        if ($status instanceof \Exception)
            return redirect()->back()->with('error', $pagseguro->errorMessage($status))->withInput();

        if ($request->save_card)
            auth()->user()->updateCard($form);

        $user->signup($workshop, $reference);

        event(new WorkshopSignup($workshop));

        return redirect()->route('client.workshops.index')->with('status', 'A sua reserva foi confirmada com sucesso.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.workshops.create.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CreateWorkshopForm $form)
    {
        $workshop = Workshop::create([
            'slug' => str_slug($request->name),
            'name' => $request->name,
            'headline' => $request->headline,
            'description' => $request->description,
            'fee' => $request->fee,
            'discount' => $request->discount,
            'cover_image' => (new Cropper($request))->make('cover_image')->saveTo('workshops/cover_images/')->getPath(),
            'capacity' => $request->capacity,
            'starts_at' => Carbon::parse($request->date)->setTime($request->start_time,0,0),
            'ends_at' => Carbon::parse($request->date)->setTime($request->end_time,0,0)
        ]);

        return redirect()->route('admin.workshops.edit', $workshop->slug)->with('status', 'O workshop foi criado com sucesso.');
    }

    public function imageUpload(Request $request)
    {
        $path = $request->file('image')->store('workshops/content_images', 'public');

        return asset('storage/' . $path);
    }

    public function imageRemove(Request $request)
    {
        $file = strstr($request->image_path, 'workshops');

        \Storage::disk('public')->delete($file);

        return response(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function show(Workshop $workshop)
    {
        return view('pages.workshops.show.index', compact('workshop'));
    }

    public function status(Request $request)
    {
        $user_type = $request->user_type;
        $reservation = UserWorkshop::find($request->reservation_id);

        return view('components.modals.results.workshop', compact(['reservation', 'user_type']))->render();
    }

    public function details(Workshop $workshop)
    {
        return view('admin.pages.workshops.details.index', compact('workshop'));        
    }

   public function cancel(Workshop $workshop, Request $request)
   {
        $reservation = UserWorkshop::find($request->reservation_id);

        if ($reservation->payment()->exists()) {
            $pagseguro = new PagSeguro;

            if ($reservation->canBeReturned()) {
                $pagseguro->refund($reservation);
            } else {
                $pagseguro->cancel($reservation);                
            }
        }

        $reservation->cancel();

        return redirect()->back()->with('status', 'Esta reserva foi cancelada com sucesso.');
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function edit(Workshop $workshop)
    {
        return view('admin.pages.workshops.edit.index', compact('workshop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workshop $workshop)
    {
        if ($request->has('cover_image')) {
            \Storage::disk('public')->delete($workshop->cover_image);

            $workshop->update([
                'cover_image' => (new Cropper($request))->make('cover_image')->saveTo('workshops/cover_images/')->getPath()
            ]);
        } else {
            $workshop->updateOrIgnore($request);
        }

        return redirect()->route('admin.workshops.edit', $workshop->slug)->with('status', 'O workshop foi editado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workshop $workshop)
    {
        $workshop->delete();

        return redirect()->route('admin.workshops.index')->with('status', 'O workshop foi editado com sucesso.');
    }
}
