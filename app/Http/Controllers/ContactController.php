<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;
use App\Models\EmailReply;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('permission:about-list|about-create|about-edit|about-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:about-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:about-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:about-delete', ['only' => ['destroy']]);
    }
    public function showContactForm()
    {
        return view('contact');
    }

    public function submitContactForm(Request $request)
    {
        $validatedData = $request->validate([
            'name_contact' => 'required|string|max:255',
            'phone_contact' => 'required|string|max:20',
            'email_contact' => 'required|email|max:255',
            'address_contact' => 'required|string|max:255',
            'message_contact' => 'nullable|string',
        ]);

        $contact = new Contact();
        $contact->name_contact = $request->input('name_contact');
        $contact->email_contact = $request->input('email_contact');
        $contact->phone_contact = $request->input('phone_contact');
        $contact->address_contact = $request->input('address_contact');
        $contact->message_contact = $request->input('message_contact');
        $contact->save();
        return redirect()->route('contact');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.about.email');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = Contact::orderBy('id', 'DESC')->get();
        return view('admin.about.form', compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        Contact::find($id)->delete();
        toastr()->info('Thành công', 'Xóa liên hệ thành công');
        return redirect()->back();
    }
    public function about_choose(Request $request)
    {
        $data = $request->all();
        $contact = Contact::find($data['id']);
        $contact->status = $data['trangthai_val'];
        $contact->save();
    }



    public function sendEmail(Request $request)
    {
        $to = $request->input('emailContact');
        $subject = $request->input('subject');
        $message = $request->input('message');
        $attachment = $request->file('attachment');
        $contactId = $request->input('contact_id');

        $emailReply = new EmailReply();
        $emailReply->contact_id = $contactId;
        $emailReply->user_id = auth()->id();
        $emailReply->to = $to;
        $emailReply->subject = $subject;
        $emailReply->message = $message;
        $attachmentPath = NULL;

        // Lưu file attachment vào thư mục public
        if ($attachment) {
            $attachmentPath = $attachment->store('attachments', 'public');
            $emailReply->attachment = $attachmentPath;
        }

        $emailReply->save();

        // Gửi email
        Mail::to($to)->send(new SendEmail($subject, $message, $attachmentPath));

        toastr()->info('Thành công', 'Gửi email thành công');
        return redirect()->back();
    }

    public function sent()
    {
        $list = EmailReply::with('contact','user')->orderBy('id', 'DESC')->get();
        return view('admin.about.sent', compact('list'));
    }
    public function destroy_sent(string $id)
    {
        $emailReply = EmailReply::find($id);

        // Kiểm tra xem có attachment hay không
        if ($emailReply->attachment) {
            // Xóa file từ thư mục storage
            Storage::disk('public')->delete($emailReply->attachment);
        }

        // Xóa dữ liệu trong cơ sở dữ liệu
        $emailReply->delete();

        toastr()->info('Thành công', 'Xóa liên hệ thành công');
        return redirect()->back();
    }
}
