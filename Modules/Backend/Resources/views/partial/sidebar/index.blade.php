<section class="sidebar">

    {{-- Sidebar menu --}}
    <ul class="sidebar-menu tree" data-widget="treeview" role="menu">
        @each('backend::partial.sidebar.menu-item', config('adminlte.menu'), 'item')
    </ul>


</section>
