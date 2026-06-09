<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">
            Cadastro Livros
        </span>
    </a>

    <div class="sidebar">

        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">
            Books
        </span>
            </a>

            <div class="sidebar">


                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Cadastros
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('book.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Livros</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('author.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Autores</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('subject.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Assuntos</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>
                                Relatórios
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('reports.books-author') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Livros por Autor</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                </ul>

            </div>

        </aside>

        </nav>

    </div>

</aside>
