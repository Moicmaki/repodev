<?php

namespace App\Http\Controllers;

use App\Providers\MembersHelperServiceProvider;
use App\Providers\PostsHelperServiceProvider;
use Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JavaScript;
use View;
use App\Model\UserVerify;

class FeedController extends Controller
{
    /**
     * Renders feed items.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        // Avoid (browser) page caching when hitting back button
        header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
        header('Pragma: no-cache'); // HTTP 1.0.
        header('Expires: 0 '); // Proxies.

        $startPage = PostsHelperServiceProvider::getFeedStartPage(PostsHelperServiceProvider::getPrevPage($request));
        $posts = PostsHelperServiceProvider::getFeedPosts(Auth::user()->id, false, $startPage);
        PostsHelperServiceProvider::shouldDeletePaginationCookie($request);


  
       // Récupérer 6 enregistrements de manière aléatoire où le statut est 'verified' et compte_createur est 'oui'
        $userVerifieds = UserVerify::where('status', 'verified')
        ->where('compte_createur', 'oui')
        ->inRandomOrder()
        ->take(8)
        ->with('user')
        ->get();

       // Fetch paginated posts and their attachments for all verified users who are creators, 6 posts per page
       $allPosts = \DB::table('posts')
       ->leftJoin('attachments', 'posts.id', '=', 'attachments.post_id')
       ->leftJoin('users', 'posts.user_id', '=', 'users.id') // Join with users table to get user data
       ->leftJoin('user_verifies', 'posts.user_id', '=', 'user_verifies.user_id')
       ->select('posts.*', 'attachments.filename as attachment_filename', 'attachments.id as attachment_id', 'users.username', 'users.avatar')
       ->where('user_verifies.status', 'verified')
       ->where('user_verifies.compte_createur', 'oui')
       ->orderBy('posts.created_at', 'desc')
       ->paginate(6); // Set the number of posts per page to 6

        JavaScript::put([
            'paginatorConfig' => [
                'next_page_url' => str_replace('/feed?page=', '/feed/posts?page=', $posts->nextPageUrl()),
                'prev_page_url' => str_replace('/feed?page=', '/feed/posts?page=', $posts->previousPageUrl()),
                'current_page' => $posts->currentPage(),
                'total' => $posts->total(),
                'per_page' => $posts->perPage(),
                'hasMore' => $posts->hasMorePages(),
            ],
            'initialPostIDs' => $posts->pluck('id')->toArray(),
            'sliderConfig' => [
              'autoslide'=> getSetting('feed.feed_suggestions_autoplay') ? true : false,
            ],
            'user' => [
                'username' => Auth::user()->username,
                'user_id' => Auth::user()->id,
                'lists' => [
                    'blocked'=>Auth::user()->lists->firstWhere('type', 'blocked')->id,
                    'following'=>Auth::user()->lists->firstWhere('type', 'following')->id,
                ],
            ],

        ]);

        return view('pages.feed', [
            'posts' => $posts,
            'suggestions' => MembersHelperServiceProvider::getSuggestedMembers(),
           'userVerifieds' => $userVerifieds,
           'allPosts' => $allPosts, // Adding paginated posts data
        ]);
    }

    /**
     * Returns ( paginated ) feed psots.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFeedPosts(Request $request)
    {
        return response()->json(['success'=>true, 'data'=>PostsHelperServiceProvider::getFeedPosts(Auth::user()->id, true)]);
    }

    /**
     * Returns lists of suggested members.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filterSuggestedMembers(Request $request)
    {
        return response()->json(['success'=>true, 'data'=>MembersHelperServiceProvider::getSuggestedMembers(true, $request->get('filters'))]);
    }
}
