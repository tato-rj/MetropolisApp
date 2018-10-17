      <li class="nav-item dropdown p-2">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{$title}}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          @foreach($items as $item)
          <a class="dropdown-item" href="{{$item['url']}}">{{$item['title']}}</a>
          @endforeach
        </div>
      </li>