<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href=" {{ route('home') }} ">BLOGADHE</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">BA</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="dropdown">
          <a href=" {{ route('home') }} " class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        </li>
        <li class="menu-header">Starter</li>
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-clipboard"></i> <span>Kategori</span></a>
          <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('category.index') }}">List Kategori</a></li>
          </ul>
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-bookmark"></i> <span>Tags</span></a>
          <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('tags.index') }}">List Tags</a></li>
          </ul>
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-book-open"></i> <span>Posts</span></a>
          <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('posts.index') }}">List Posts</a></li>
          </ul>
        </li>
   </aside>
  </div>