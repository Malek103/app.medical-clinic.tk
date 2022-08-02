<nav id="sidebar">

                <ul class="list-unstyled menu-categories" id="accordionExample">

                    <li class="menu">
                        <a href="/" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>{{__('lang.home')}}</span>
                            </div>
                        </a>
                    </li>



                    <li class="menu">
                        <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="fas fa-users"></i>
                                <span>{{__('lang.users')}}</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="users" data-parent="#accordionExample">
                            <li>
                                <a href="/users"> {{__('lang.show')}} </a>
                            </li>
                            <li>
                                <a href="/users/create">{{__('lang.create')}}  </a>
                            </li>

                        </ul>
                    </li>

                    <li class="menu">
                        <a href="#customers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="fas fa-users"></i>
                                <span>{{__('lang.customers')}}</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="customers" data-parent="#accordionExample">
                            <li>
                                <a href="/customers"> {{__('lang.show')}} </a>
                            </li>
                            <li>
                                <a href="/customers/create">{{__('lang.create')}}  </a>
                            </li>

                        </ul>
                    </li>

                    <li class="menu">
                        <a href="#xrays" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="fas fa-list"></i>
                                <span>{{__('lang.xrays')}}</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="xrays" data-parent="#accordionExample">
                            <li>
                                <a href="/xrays"> {{__('lang.show')}} </a>
                            </li>
                            <li>
                                <a href="/xrays/create">{{__('lang.create')}}  </a>
                            </li>

                        </ul>
                    </li>

                    <li class="menu">
                        <a href="#medicines" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="fas fa-list"></i>
                                <span>{{__('lang.medicines')}}</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="medicines" data-parent="#accordionExample">
                            <li>
                                <a href="/medicines"> {{__('lang.show')}} </a>
                            </li>
                            <li>
                                <a href="/medicines/create">{{__('lang.create')}}  </a>
                            </li>



                        </ul>
                    </li>

                    <li class="menu">
                        <a href="#examinations" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="fas fa-list"></i>
                                <span>{{__('lang.medical_examinations')}}</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="examinations" data-parent="#accordionExample">
                            <li>
                                <a href="/examinations"> {{__('lang.show')}} </a>
                            </li>
                            <li>
                                <a href="/examinations/create">{{__('lang.create')}}   </a>
                            </li>

                            <li>
                                <a href="/examinations/category/index">{{__('lang.category')}}  </a>
                            </li>

                        </ul>
                    </li>

                    <li class="menu">
                        <a href="#reservations" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="fas fa-clock"></i>
                                <span>{{__('lang.reservations')}}</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="reservations" data-parent="#accordionExample">
                            <li>
                                <a href="/reservations?date_from={{date('Y-m-d')}}&date_to={{date('Y-m-d')}}"> {{__('lang.today_reservations')}}  </a>
                            </li>
                            <li>
                                <a href="/reservations"> {{__('lang.all_reservations')}}  </a>
                            </li>
                            <li>
                                <a href="/reservations/calendar"> {{__('lang.calendar')}}  </a>
                            </li>
                            <li>
                                <a href="/reservations/create">{{__('lang.create')}}   </a>
                            </li>

                        </ul>
                    </li>


                    <li class="menu">
                        <a href="#accounting" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="fas fa-money-bill"></i>
                                <span>{{__('lang.accounting')}}</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="accounting" data-parent="#accordionExample">
                            <li>
                                <a href="/accounting/payments"> {{__('lang.earnings')}} </a>
                            </li>
                            <li>
                                <a href="/accounting/expenses"> {{__('lang.expenses')}} </a>
                            </li>
                            <li>
                                <a href="/accounting/transactions"> {{__('lang.transactions')}}  </a>
                            </li>

                        </ul>
                    </li>

                    <li class="menu">
                        <a href="/getReadyList" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="fas fa-file"></i>
                                <span>{{__('lang.ready_list')}}</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="/backups" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="fas fa-cloud"></i>
                                <span>{{__('lang.backup')}}</span>
                            </div>
                        </a>
                    </li>


                </ul>

            </nav>
