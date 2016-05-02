<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;
use Witty\LaravelTableView\Facades\TableView;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use App\Forms\Admin\UsersForm;
use Crypt;
use Debugbar;
use DB;
class UserController extends AdminController
{
    use FormBuilderTrait;

    public function __construct(User $model)
    {
        $this->indexRoute = 'users';
        $this->createRoute = 'user::create';
        $this->editRoute = 'user::edit';
        $this->pluralTitle = 'Users';
        $this->model = $model;

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // var_dump(response()->caps('foo'));exit();
        $objects = User::select();

        if (!isset($_GET['sortedBy'])) {
            $objects->orderBy('id', 'desc');
        }

        $tableView = TableView::collection($objects);
        $tableView
            ->column('Name', ['name:sort,search' => function ($object) {
                return view($this->viewNormalLink, [
                    'href' => route('admin::user::show', ['object' => $object->id]),
                    'label' => $object->name,
                ]);
            }])            
            ->column('Email', 'email:sort,search')
            ->column('Role', ['role_id:sort*' => function ($object) {               

                return $object->role_id == 1 ? 'Admin' : 'User';
            }])             
            ->column(function ($object) {
                return view($this->viewEditDelIcon, [
                    'showLink' => route('admin::user::show', ['object' => $object->id]),
                    'editLink' => route('admin::user::edit', ['object' => $object->id]),
                    'delLink' => route('admin::user::delete', ['object' => $object->id]),
                    'delClass' => Auth::user()->id == $object->id ? 'dis-class' : '',
                    'warningDelMsg' => 'Are you sure you want to delete this user. All the associated data will be deleted?',
                ]);
            })
            ->build();

        Debugbar::info($objects->get());
        Debugbar::error('Error!');
        Debugbar::warning('Watch out…');
        return view($this->viewIndex, [
            'tableView' => $tableView,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->form(UsersForm::class, [
            'method' => 'POST',
        ]);       

        return view($this->viewForm, [
            'form' => $form,            
            'title' => 'Add New User',            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $form = $this->form(UsersForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->rold_id,
        ]);

        return redirect()->route($this->indexRoute)->with('msg', $this->successStoredMsg);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function show($id)
    {
        $model = User::findOrFail($id);
        return view($this->viewShow, array(
            'object' => $model,
            'title' => 'Information',                           
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = User::findOrFail($id);
        $form = $this->form(UsersForm::class, [
            'method' => 'POST',
            'model' => $model,
        ]);

        return view($this->viewForm, array(
            'form' => $form,            
            'object' => $model,
            'title' => 'Edit User', 
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User                     $model
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $form = $this->form(UsersForm::class);

        $model = User::findOrFail($id);
        $form->validate($this->validator($model, $request->password));

        // It will automatically use current request, get the rules, and do the validation
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        
        if ($request->password) {
            $model->password = bcrypt($request->password);
        }

        $model->email   = $request->email;
        $model->name    = $request->name;        
        $model->role_id = $request->role_id;
        $model->save();
        return redirect()->route($this->indexRoute)->with('msg', $this->successUpdatedMsg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $model
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $model = User::findOrFail($id);
        $model->delete();

        return redirect(route($this->indexRoute))->with('msg', $this->successDeletedMsg);;
    }

    /**
     * Get validator.
     *
     * @param object $user
     *
     * @return array
     */
    private function validator($model = false, $password = false)
    {
        $validator = [            
            'email' => 'required|email|max:100|unique:users',
        ];

        if ($model) {            
            $validator['email']     .= ',email,'.$model->id;
            $validator['password'] = 'min:4';

            if ($password) {
                $validator['password'] .= '|confirmed';
            }
        }

        return $validator;
    }

    /**
     * Generate database for customer.
     *
     * @param $request
     *
     * @return response
     */
    public function generateDatabase(Request $request)
    {
        try {
            $userID = $request->id;
            $user = User::find($userID);
            Cache::forget($user->listingCacheKey);
            if (!$request->isMethod('post') || !$user || !$user->isCustomer()) {
                return response()->json(['response' => 'This action does not allow']);
            }

            if (!$result = Event::fire(new ActiveCustomer($user))) {
                return response()->json(['response' => 'Can not connect to your database.
                Please check the database information of user']);
            }

            return response()->json(['response' => 'Generated successfully database']);
        } catch (\Exception $e) {
            Log::error($e);

            return response()->json(['response' => 'Can not generate database.']);
        }
    }

    public function getStatic() {        
        $data = [];
        for ($key = 0; $key < 12; $key++) {            
            $data[$key] = User::select()->where( DB::raw('MONTH(created_at)'), $key + 1 )->count();
        }
        return view('admin.User.static', compact('data'));
    }
}
