<?php

namespace App\Http\Controllers;

use App\Complain;
use App\Product;
use App\Customer;
use App\User;
use App\Comment;

use App\Crm\Logger;

use Gate;

class ComplainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $complains = Complain::orderBy('id', 'desc')->paginate(5);

        return view('complain/index', [
            'complains' => $complains,
            'status' => 'all'
        ]);
    }

    public function filter($status)
    {
        switch($status) {
            case "new":
                $complains = Complain::where('status', 0)->orderBy('id', 'desc')->paginate(5);
                break;
            case "mine":
                $uid = auth()->user()->id;
                $complains = Complain::where('user_id', $uid)->orderBy('id', 'desc')->paginate(5);
                break;
            default:
                $complains = Complain::orderBy('id', 'desc')->paginate(5);
        }

        return view('complain/index', [
            'complains' => $complains,
            'status' => $status
        ]);
    }

    public function status($id, $status, Logger $logger)
    {
        $complain = Complain::find($id);
        $complain->status = $status;
        $complain->save();

        $content = auth()->user()->name;
        $content .= ' changed status to ';
        $content .= config('crm.status')[$status];
        $content .= ' - ';
        $content .= $complain->created_at;
        $logger->save($id, $content);

        return back();
    }

    public function assign($id, $user)
    {
        if(Gate::denies('assign')) {
            return back()->with('info', 'Unauthorize to assign');
        }

        $complain = Complain::find($id);
        $complain->user_id = $user;
        $complain->save();

        return back();
    }

    public function view($id)
    {
        $complain = Complain::find($id);
        $users = User::all();

        return view('complain/view', [
            'complain' => $complain,
            'users' => $users
        ]);
    }

    public function add()
    {
        return view('complain/add', [
            'products' => Product::all(),
            'customers' => Customer::all()
        ]);
    }

    public function create()
    {
        $complain = new Complain();
        $complain->subject = request()->subject;
        $complain->detail = request()->detail;
        $complain->customer_id = request()->customer_id;
        $complain->product_id = request()->product_id;
        $complain->save();

        return redirect('complains');
    }

    public function edit($id)
    {
        $complain = Complain::find($id);

        return view('complain/edit', [
            'complain' => $complain
        ]);
    }

    public function update($id)
    {
        $complain = Complain::find($id);
        $complain->subject = request()->subject;
        $complain->detail = request()->detail;
        $complain->save();

        return redirect('complains');
    }

    public function delete($id)
    {
        $complain = Complain::find($id);
        $complain->delete();

        return redirect('complains');
    }

    /*** Comments ***/
    public function addComment()
    {
        $comment = new Comment();
        $comment->comment = request()->comment;
        $comment->user_id = request()->user_id;
        $comment->complain_id = request()->complain_id;
        $comment->save();

        return back();
    }

    public function deleteComment($id)
    {
        $comment = Comment::find($id);

        if(Gate::denies('comment-delete', $comment)) {
            return back()->with('info', 'Unauthorize to delete comment');
        }

        $comment->delete();

        return back();
    }
}
