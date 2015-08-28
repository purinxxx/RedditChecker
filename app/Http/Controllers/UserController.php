<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($username)
	{
		//
		set_time_limit(0);
		$data = array(); //結果
		$goukei=0;
		$co="";
		$su="";
		$jikancom = array(); //時間別グラフ用の配列(0-23)
		foreach(range(0,23) as $i){
			$jikancom[$i] = 0;
		}
		$jikansub = array(); //時間別グラフ用の配列(0-23)
		foreach(range(0,23) as $i){
			$jikansub[$i] = 0;
		}
		$url = "http://www.reddit.com/user/" . $username . "/about.json";
		$json = file_get_contents($url);
		$about = json_decode( $json , true );
		$createdtime = $about["data"]["created"];
		$sa = time() - $createdtime + 9*3600; //UTC時間とJST時間の時差調整
		$sa = $sa / 3600 / 24;

		$url = "https://www.reddit.com/user/" . $username . "/comments/.json?limit=100";
		$json = file_get_contents($url);
		$come = json_decode( $json , true );
		$i=0;
		while ($i < count($come["data"]["children"])) {
			$jikan = date("G", $come["data"]["children"][$i]["data"]["created_utc"] + 9*3600);
			$jikancom[$jikan]++;
			$i++;
			if (is_null($come["data"]["after"]) && $i==count($come["data"]["children"])-1){
				if ($i==0){break;}
				$jikan = date("G", $come["data"]["children"][$i]["data"]["created_utc"] + 9*3600);
				$jikancom[$jikan]++;
				break;
			}
			if ($i == count($come["data"]["children"])){
				$url = "https://www.reddit.com/user/" . $username . "/comments/.json?limit=100&after=" . $come["data"]["after"];
				$json = file_get_contents($url);
				$come = json_decode( $json , true );
				$i=0;
			}
		}

		$url = "https://www.reddit.com/user/" . $username . "/submitted/.json?limit=100";
		$json = file_get_contents($url);
		$come = json_decode( $json , true );
		$i=0;
		while ($i < count($come["data"]["children"])) {
			$jikan = date("G", $come["data"]["children"][$i]["data"]["created_utc"] + 9*3600);
			$jikansub[$jikan]++;
			$i++;
			if ($i == count($come["data"]["children"])){
				$url = "https://www.reddit.com/user/" . $username . "/submitted/.json?limit=100&after=" . $come["data"]["after"];
				$json = file_get_contents($url);
				$come = json_decode( $json , true );
				$i=0;
			}
			if (is_null($come["data"]["after"]) && $i==count($come["data"]["children"])-1){
				if ($i==0){break;}
				$jikan = date("G", $come["data"]["children"][$i]["data"]["created_utc"] + 9*3600);
				$jikansub[$jikan]++;
				break;
			}
		}
		foreach ($jikancom as $key => $value){
			$goukei+=$value;
		}
		foreach ($jikansub as $key => $value){
			$goukei+=$value;
		}
		foreach ($jikancom as $key => $value){
			$co .= strval($value).",";
		};
		foreach ($jikansub as $key => $value){
			$su .= strval($value).",";
		};

		$data['username']=$about["data"]["name"];
		$data['link_karma']=$about["data"]["link_karma"];
		$data['comment_karma']=$about["data"]["comment_karma"];
		$data['age']=floor($sa);
		$data['goukei']=$goukei;
		$data['heikin']=round($goukei/floor($sa),1);
		$data['comments']=$co;
		$data['submitted']=$su;
		var_dump($data);
		//$data['comments']='15, 13, 2, 0, 0 , 0, 2, 2, 1, 3, 5, 6, 6, 11, 12, 13, 5, 22, 26, 28, 27, 22, 23, 19';
		//$data['submitted']='2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 0, 1, 0, 4, 1, 0, 8, 3, 1, 3, 4, 0';
		return view('user', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
