<?php

namespace App\Http\Controllers\PisControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PisModel\Notification;
use App\Models\PisModel\Staff;
use App\Models\PisModel\StaffTask;
use App\Models\PisModel\StaffTaskAssign;
use App\Models\PisModel\StaffTaskComments;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function task_list()
    {
        $staff = Staff::query()->where('user_id', auth()->user()->id)->first();
        if (Auth::user()->hasRole('cao') == false) {
            if ($staff == null) {
                return redirect()->back()->with('msg', 'सुरुमा कर्मचारी विवरण भर्नुहोस्');
            } else {
                if ($staff->is_approved == 0) {
                    return redirect()->back()->with('msg', 'स्वीकृत हुन् वाकी');
                } elseif ($staff->is_approved == 2) {
                    return redirect()->back()->with('msg', 'तपाइको विवरण अस्वीकृत भएकोछ');
                }
            }
        }
        if (Auth::user()->hasRole('cao')) {
            $tasks = StaffTask::query()->with(['staffs', 'stafftasks'])->get();
            $auth = 'cao';
        } elseif (Auth::user()->hasRole('admin')) {
            $staff_id = Staff::query()->where('user_id', auth()->user()->id)->first();
            $tasks = StaffTask::query()->with(['staffs', 'stafftasks'])->whereHas('stafftasks', function ($query) use ($staff_id) {
                $query->where('staff_id', $staff_id->id);
            })
                ->get();
            $auth = 'admin';
        } elseif (Auth::user()->hasRole('user')) {
            $staff_id = Staff::query()->where('user_id', auth()->user()->id)->first();
            $tasks = StaffTask::query()->with(['staffs', 'stafftasks'])->whereHas('stafftasks', function ($query) use ($staff_id) {
                $query->where('staff_id', $staff_id->id);
            })
                ->get();
            $auth = 'user';
        }

        return view('pis.staff.task.task-list', [
            'tasks' => $tasks,
            'auth' => $auth
        ]);
    }
    public function task_add()
    {
        $staff = Staff::query()->where('user_id', auth()->user()->id)->first();
        if (Auth::user()->hasRole('cao') == false) {

            if ($staff == null) {
                return redirect()->back()->with('msg', 'सुरुमा कर्मचारी विवरण भर्नुहोस्');
            } else {
                if ($staff->is_verified == 0) {
                    return redirect()->back()->with('msg', 'स्वीकृत हुन् वाकी');
                } elseif ($staff->is_verified == 2) {
                    return redirect()->back()->with('msg', 'तपाइको विवरण अस्वीकृत भएकोछ');
                }
            }
        }
        return view('pis.staff.task.task-add');
    }

    public function task_store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'task_name' => 'required',
            'task_description' => 'required',
            'has_deadline' => 'required',
            'deadline_type' => 'required',
        ]);


        if ($request->deadline_type == 1) {
            $request->validate([
                "start_date" => "required",
                "finish_date" => "required"
            ]);
        } else {
            $request->validate([
                "start_time" => "required",
                "finish_time" => "required"
            ]);
        }

        StaffTask::create([
            'date' => $request->date,
            'task_name' => $request->task_name,
            'task_description' => $request->task_description,
            'start_date' => $request->start_date,
            'finish_date' => $request->finish_date,
            'start_time' => $request->start_time,
            'finish_time' => $request->finish_time,
            'giver_id' => auth()->user()->id,
            'has_deadline' => $request->has_deadline,
            'deadline_type' => $request->deadline_type
        ]);

        return redirect()->route('task-list')->with('msg', 'कार्य थप्न सफल भयो');
    }

    public function assign_task(Request $request)
    {
        $user_id = Staff::query()->where('id', $request->user_id)->first()->user_id;
        $user =  User::query()->with('roles')->where('id', $user_id)->with('staffs')->first();
        $user_role = $user->roles[1]->name;

        if ($user_role == 'admin') {
            $role_id = config('pis_constant.ADMIN_ID');
        } elseif ($user_role == 'cao') {
            $role_id = config('pis_constant.CAO');
        } else {
            $role_id = config('pis_constant.USER_ID');
        }

        $request->validate([
            'user_id.*' => 'required',
            'user_id' => 'required'
        ]);

        foreach ($request->user_id as $key => $value) {
            $id = StaffTaskAssign::create([
                'staff_id' => $request->user_id[$key],
                'staff_task_id' => $request->staff_task_id
            ]);
            Notification::create([
                'event_id' => $id->id,
                'text' => 'तपाईलाई कार्य प्रदान गरिएको छ',
                'is_read' => 0,
                'role_id' => $role_id,
                'staff_id' => $request->user_id[$key],
                'noti_type' => config('pis_constant.NOTI_TYPE')
            ]);
        }
        return redirect()->route('task-list')->with('msg', 'कार्य प्रदान गर्न सफल भयो');
    }

    public function assigned_task_list($staffTask)
    {
        $staff = Staff::query()->where('user_id', auth()->user()->id)->first();
        if (Auth::user()->hasRole('user') || Auth::user()->hasRole('admin')) {
            $tasked = StaffTask::query()->where('id', $staffTask)->with('stafftasks', function ($query) use ($staff) {
                $query->where('staff_id', $staff->id);
            })->first();
        } else {
            $tasked = StaffTask::query()->where('id', $staffTask)->with('stafftasks')->first();
        }

        return view(
            'pis.staff.task.task-assigned-list',
            [
                'tasked' => $tasked,
                'staff' => $staff
            ]
        );
    }

    public function assigned_task_comment($id)
    {
        $taskAssign = StaffTaskAssign::query()->with('staffs')->where('id', $id)->first();
        $task = StaffTask::query()->where('id', $taskAssign->staff_task_id)->with('staffs')->first();
        $messages = StaffTaskComments::query()->where('task_assign_id', $id)->with('staffs')->orderBy('created_at', 'ASC')->get();
        return view('pis.staff.task.task-assigned-comments', [
            'id' => $id,
            'taskAssign' => $taskAssign,
            'task' => $task,
            'messages' => $messages
        ]);
    }

    public function assigned_task_comment_submit(Request $request)
    {
        $taskAssign = StaffTaskAssign::query()->where('id', $request->task_assign_id)->with('tasks')->first();
        $user =  User::query()->with('roles')->where('id', $request->receiver_id)->with('staffs')->first();
        foreach ($user->staffs as $key => $value) {
            $receiver_staff_id = $value->id;
        }
        $user_role = $user->roles[1]->name;
        $request->validate([
            'comment' => 'required'
        ]);

        $latest =  StaffTaskComments::create([
            'task_assign_id' => $request->task_assign_id,
            'staff_id' => auth()->user()->id,
            'comment' => $request->comment
        ]);



        if ($user_role == 'cao') {
            Notification::create([
                'event_id' => $latest->id,
                'text' => $taskAssign->tasks->task_name . 'को टिप्पणी आको छ',
                'is_read' => 0,
                'role_id' => config('pis_constant.CAO'),
                'noti_type' => 'task',
                'staff_id' => $receiver_staff_id
            ]);
        } elseif ($user_role == 'user') {
            Notification::create([
                'event_id' => $latest->id,
                'text' => $taskAssign->tasks->task_name . 'को टिप्पणी आको छ',
                'is_read' => 0,
                'role_id' => config('pis_constant.USER_ID'),
                'noti_type' => 'task',
                'staff_id' => $receiver_staff_id
            ]);
        } else {
            Notification::create([
                'event_id' => $latest->id,
                'text' => $taskAssign->tasks->task_name . 'को टिप्पणी आको छ',
                'is_read' => 0,
                'role_id' => config('pis_constant.ADMIN_ID'),
                'noti_type' => 'task',
                'staff_id' => $receiver_staff_id
            ]);
        }



        return redirect()->back();
    }


    public function test()
    {
        if (Auth::user()->hasRole('cao')) {
            $user =  User::query()->with('roles')->whereHas("roles", function ($q) {
                $q->where("name", "admin")->orWhere("name", "user");
            })->get();
        }

        if (Auth::user()->hasRole('admin')) {
            $user =  User::query()->with('roles')->whereHas("roles", function ($q) {
                $q->where("name", "user");
            })->get();
        }
    }

    public function getUsers(Request $request)
    {
        $task = StaffTask::query()->where('id', $request->task_id)->first();
        if ($request->auth == 'cao') {
            $user =  User::query()->with('roles')->with('staffs')->whereHas("roles", function ($q) {
                $q->where("name", "admin")->orWhere("name", "user");
            })->get();
        }

        if ($request->auth == 'admin') {
            $user =  User::query()->with('roles')->with('staffs')->whereHas("roles", function ($q) {
                $q->where("name", "user");
            })->get();
        }

        if ($request->auth == 'user') {
            $user =  User::query()->with('roles')->with('staffs')->whereHas("roles", function ($q) {
                $q->where("name", "user");
            })->get();
        }
        return response()->json([
            'user' => $user,
            'task' => $task
        ]);
    }
}
