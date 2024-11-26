<?php

namespace App\Http\Controllers\Auth;

use App\Models\Buku; //tambahan
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    /**
     * Constructor: Apply middleware to restrict access.
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except(['logout', 'dashboard']);
    //     //guest untuk user belum registrasi dan yg hanya bisa mengakses ya guest itu sendiri
    // }

    /**
     * Display a registration form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Store a new user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //untuk menambah user baru
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed',
            'photo' => 'image|nullable|max:1999'
        ]);

        if ($request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('photo')->storeAs('photos', $filenameSimpan);
        } else {
            $path = null; // Default value if no photo is uploaded
        }
        
        // Create a new user to add to the database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash to secure the password
            'photo' => $path
        ]);
        
         // Attempt to login the user after registration
    $credentials = $request->only('email', 'password');
    Auth::attempt($credentials);
    $request->session()->regenerate();

    return redirect()->route('dashboard')
        ->withSuccess('You have successfully registered & logged in!');
    }

    /**
     * Display the login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('auth.login');
    }

    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'dashboard']);
    }

    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
     public function authenticate(Request $request)
     {
         $credentials = $request->validate([
             'email' => 'required|email',
             'password' => 'required',
         ]);
     
         if (Auth::attempt($credentials)) {
             $request->session()->regenerate(); // Menghasilkan sesi baru setelah autentikasi
     
             return redirect()->route('dashboard')
                 ->withSuccess('You have successfully logged in!');
         }
     
         return back()->withErrors([
             'email' => 'Your provided credentials do not match in our records.',
         ])->onlyInput('email');
     }

        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect()->route('dashboard')
        //         ->withSuccess('You have successfully logged in!');
        // }

    /**
     * Display the dashboard to authenticated users.
     * 
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
{
    if (Auth::check()) {
        $user = Auth::user();
        
        if ($user->level === 'admin') {
            // Ambil data buku untuk dashboard admin
            $data_buku = Buku::all();
            $jumlah_buku = $data_buku->count();
            $total_harga = $data_buku->sum('harga');

            return view('auth.dashboard', compact('data_buku', 'jumlah_buku', 'total_harga'));
        } else {
            // Jika user biasa, arahkan ke halaman home
            return view('home');
        }
    }

    return redirect()->route('login')
        ->withErrors(['email' => 'Please login to access the dashboard.'])
        ->onlyInput('email');
}

    // public function dashboard()
    // {
    //     if (Auth::check()) {
    //         // Retrieve books to display on the dashboard
    //         $data_buku = Buku::all();
    //         $jumlah_buku = $data_buku->count();
    //         $total_harga = $data_buku->sum('harga');
    
    //         return view('auth.dashboard', compact('data_buku', 'jumlah_buku', 'total_harga'));
    //     }
    
    //     return redirect()->route('login')
    //         ->withErrors(['email' => 'Please login to access the dashboard.'])
    //         ->onlyInput('email');
    // }

    /**
     * Log out the user from the application.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
        ->withSuccess('You have logged out successfully!');
    }

    
    
}

// //tambahan dashboard
// {
//     if (Auth::check()) {
//         return view('auth.dashboard');
//     }

//     return redirect()->route('login')
//         ->withErrors(['email' => 'Please login to access the dashboard.'])
//         ->onlyInput('email');
        
// }