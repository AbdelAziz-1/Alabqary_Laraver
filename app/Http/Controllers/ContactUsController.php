<?php
namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    // عرض جميع الرسائل
    public function index()
    {
        $contacts = ContactUs::all(); // جلب كل الرسائل بترتيب زمني تنازلي
        return view('general.contactUs.contact-us', compact('contacts'));
    }

    // عرض صفحة إنشاء رسالة جديدة
    public function create()
    {
        //resources\views\general\contactUs\contact-us.blade.php
        return view('general.contactUs.contact-us');
    }

    // تخزين رسالة جديدة
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactUs::create($request->all());

        return redirect()->route('contact-us.index')->with('success', 'Message created successfully!');
    }

    // عرض صفحة تعديل رسالة
    public function edit($id)
    {
        $contact = ContactUs::findOrFail($id); // جلب الرسالة بناءً على الـ ID
        return view('general.contactUs.contact-us', compact('contact'));
    }

    // تحديث رسالة
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $message = ContactUs::findOrFail($id);
        $message->update($request->all());

        return redirect()->route('contact-us.index')->with('success', 'Message updated successfully!');
    }

    // حذف رسالة
    public function destroy($id)
    {
        $contact = ContactUs::findOrFail($id);
        $contact->delete();

        return redirect()->route('contact-us.index')->with('success', 'Message deleted successfully!');
    }
}
