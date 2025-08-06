<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Announcement;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();

        return view('notifications.index', ['notifications' => $notifications]);
    }

    public function edit($userID)
    {

        return view('notifications.edit', ['userID' => $userID]);
    }

    public function update(Request $request, $userID)
    {
        $valid = $request ->validate([
            'notificationText' => 'required|string|max:255',
        ]);

        $notification = Notification::create([
            'notificationText' => $valid['notificationText'],
            'userID' => $userID,
        ]);

        $notification->save();

        return to_route('notifications.index')-> with('success', 'Notification Sent Successfully !');
    }

    public function destroy($notificationID)
    {
        $notification = Notification::findOrFail($notificationID);
        $notification->delete();
        
        return to_route('notifications.index') -> with('success', 'Notification Deleted Successfully !');
    }

    public function showAnnouncementForm($courseID)
    {
        return view('notificationsViews.showAnnouncementForm', ['courseID' => $courseID]);
    }

    public function storeAnnouncement(Request $request, $courseID)
    {
        $valid = $request -> validate([
            'announcementText' => 'required|string|max:255',
        ]);

        $announcement = Announcement::create([
            'announcementText' => $valid['announcementText'],
            'courseID' => $courseID,
        ]);

        $announcement->save();

        return to_route('courses.assignedCourses') -> with('success', 'Announcement Sent Successfully !');;

    }

}
