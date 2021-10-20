<!DOCTYPE html>
<html>
<head>
 <title>Post Notification</title>
</head>
<body>
 <h2>{{$data['greeting']}}</h2>
 <h4>A new Post is listed on our website, </h4>
 <h3>Title : {{$data['title']}}</h3>
 <h3>Description : </h3>
 <p>{{$data['description']}}</p>
 <h3>{{$data['thanks']}}</h3>
</body>
</html> 