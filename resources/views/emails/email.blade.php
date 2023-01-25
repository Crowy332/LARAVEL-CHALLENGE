<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div class = "text-dark fs-2">
        Now we have new company!
    </div>
    <div class = "col-sm-12 row">
        @if ($logo)
        <div class = "col-auto">
            <img class = "w-75 h-100" src="{{ url('storage/'.$logo) }}" alt="" title="" />
        </div>
        @endif
        <div class = "col-auto">
            <div class = "fs-4">
                {{__('Name is')}} {{$name}}
            </div>
            <div class = "fs-4">
                {{__('email is')}} {{$email ? $email : "-"}}
            </div>
            <div class = "fs-4">
                {{__('Address')}} {{$address ? $address : "-"}}
            </div>
            <div class = "fs-4">
                {{__('website is')}} {{$website ? $website : "-"}}
            </div>
        </div>
    </div>

</body>
</html>

