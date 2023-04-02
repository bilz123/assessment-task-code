<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view ('admindashboard.events.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admindashboard.events.modal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            Event::create([
                'event_name' => $request->input('event_name'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
            ]);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::whereId($id)->first();
       

        return view('admindashboard.events.modal', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::whereId($id)->first();

        return view('admindashboard.events.modal', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = Event::whereId($id)->first();
        if (empty($event)) throw new \Exception('Record not found.', 404);

        $event->update([
            'event_name' => $request->input('event_name'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Event::whereId($id)->first();
        if (empty($coupon)) throw new \Exception('Record not found.', 404);

        $coupon->delete();

    }


    public function datatable()
    {
        $Events = Event::get();

        $dt = Datatables::of($Events);

        $dt->addColumn('event_name', function ($record) {
            return $record->event_name;
       
        });
       
        $dt->addColumn('start_date', function ($record) {
           
                return $record->start_date;
            
        });

        $dt->addColumn('end_date', function ($record) {
            return $record->end_date;
        });


        $dt->addColumn('action', function ($row) {
            $updateBtn = '
                <li>
                    <a href="' . route('events.edit', $row->id) . '"  ajax-modal>
                        <em class="icon ni ni-edit"></em>
                        <span>Update</span>
                    </a>
                </li>';

            $deleteBtn = '
                <li>
                    <a href="' . route('events.destroy', $row->id) . '" class="text-danger delete" delete-btn data-datatable="#discounts-dt">
                        <em class="icon ni ni-trash"></em>
                        <span>Delete</span>
                    </a>
                </li>';

            return '
                <ul class="nk-tb-actions gx-1">
                    <li>
                        <div class="drodown">
                            <a href="javascript:void(0);" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown">
                                <em class="icon ni ni-more-h"></em>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="link-list-opt no-bdr">
                                    ' . $updateBtn . '
                                    ' . $deleteBtn . '
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            ';
        });
        $dt->addIndexColumn();
        $dt->rawColumns(['title', 'start_date', 'end_Date',  'action']);

        return $dt->make(true);
    }
}
