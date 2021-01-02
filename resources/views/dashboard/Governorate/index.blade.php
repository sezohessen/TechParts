{{-- Extends layout --}}
@extends('layout.master')

<!--begin::Content-->

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Column Rendering Examples</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="" class="text-muted">Crud</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="" class="text-muted">Datatables.net</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="" class="text-muted">Advanced</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="" class="text-muted">Column Rendering</a>
                            </li>
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <!--begin::Actions-->
                    <a href="#" class="btn btn-light-primary font-weight-bolder btn-sm">Actions</a>
                    <!--end::Actions-->
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
                        <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="svg-icon svg-icon-success svg-icon-2x">
                                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Files/File-plus.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 m-0">
                            <!--begin::Navigation-->
                            <ul class="navi navi-hover">
                                <li class="navi-header font-weight-bold py-4">
                                    <span class="font-size-lg">Choose Label:</span>
                                    <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
                                </li>
                                <li class="navi-separator mb-3 opacity-70"></li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-success">Customer</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-danger">Partner</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-warning">Suplier</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-primary">Member</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-dark">Staff</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-separator mt-3 opacity-70"></li>
                                <li class="navi-footer py-4">
                                    <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                                    <i class="ki ki-plus icon-sm"></i>Add new</a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Notice-->
                <div class="alert alert-custom alert-white alert-shadow gutter-b" role="alert">
                    <div class="alert-icon">
                        <span class="svg-icon svg-icon-xl svg-icon-primary">
                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Tools/Compass.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3" />
                                    <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </div>
                    <div class="alert-text">Each column has an optional rendering control called columns.render which can be used to process the content of each cell before the data is used. See official documentation
                    <a class="font-weight-bold" href="https://datatables.net/examples/advanced_init/column_render.html" target="_blank">here</a>.</div>
                </div>
                <!--end::Notice-->
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-header flex-wrap py-5">
                        <div class="card-title">
                            <h3 class="card-label">Column Rendering
                            <div class="text-muted pt-2 font-size-sm">custom colu rendering</div></h3>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Dropdown-->
                            <div class="dropdown dropdown-inline mr-2">
                                <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="svg-icon svg-icon-md">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/PenAndRuller.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                            <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>Export</button>
                                <!--begin::Dropdown Menu-->
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                    <!--begin::Navigation-->
                                    <ul class="navi flex-column navi-hover py-2">
                                        <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="la la-print"></i>
                                                </span>
                                                <span class="navi-text">Print</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="la la-copy"></i>
                                                </span>
                                                <span class="navi-text">Copy</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="la la-file-excel-o"></i>
                                                </span>
                                                <span class="navi-text">Excel</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="la la-file-text-o"></i>
                                                </span>
                                                <span class="navi-text">CSV</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="la la-file-pdf-o"></i>
                                                </span>
                                                <span class="navi-text">PDF</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!--end::Navigation-->
                                </div>
                                <!--end::Dropdown Menu-->
                            </div>
                            <!--end::Dropdown-->
                            <!--begin::Button-->
                            <a href="#" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/Flatten.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <circle fill="#000000" cx="9" cy="15" r="6" />
                                        <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>New Record</a>
                            <!--end::Button-->
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                            <thead>
                                <tr>
                                    <th>Record ID</th>
                                    <th>Company Email</th>
                                    <th>Company Agent</th>
                                    <th>Company Name</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>hboule0@hp.com</td>
                                    <td>Hayes Boule</td>
                                    <td>Casper-Kerluke</td>
                                    <td>5</td>
                                    <td>1</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>hbresnen1@theguardian.com</td>
                                    <td>Humbert Bresnen</td>
                                    <td>Hodkiewicz and Sons</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>jlabro2@kickstarter.com</td>
                                    <td>Jareb Labro</td>
                                    <td>Kuhlman Inc</td>
                                    <td>6</td>
                                    <td>2</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>ktosspell3@flickr.com</td>
                                    <td>Krishnah Tosspell</td>
                                    <td>Prosacco-Kessler</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>dkernan4@mapquest.com</td>
                                    <td>Dale Kernan</td>
                                    <td>Bernier and Sons</td>
                                    <td>5</td>
                                    <td>2</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>hbentham5@nih.gov</td>
                                    <td>Halley Bentham</td>
                                    <td>Schoen-Metz</td>
                                    <td>1</td>
                                    <td>3</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>bpenddreth6@example.com</td>
                                    <td>Burgess Penddreth</td>
                                    <td>DuBuque, Stanton and Stanton</td>
                                    <td>5</td>
                                    <td>2</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>csedwick7@wikispaces.com</td>
                                    <td>Cob Sedwick</td>
                                    <td>Homenick-Nolan</td>
                                    <td>3</td>
                                    <td>2</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>tcallaghan8@squidoo.com</td>
                                    <td>Tabby Callaghan</td>
                                    <td>Daugherty-Considine</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>bjarry9@craigslist.org</td>
                                    <td>Broddy Jarry</td>
                                    <td>Walter Group</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>mmcgougana@dion.ne.jp</td>
                                    <td>Marjorie McGougan</td>
                                    <td>Littel and Sons</td>
                                    <td>6</td>
                                    <td>1</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td>espriggingb@china.com.cn</td>
                                    <td>Edsel Sprigging</td>
                                    <td>Kulas, Huels and Strosin</td>
                                    <td>6</td>
                                    <td>3</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>13</td>
                                    <td>jgouldebyc@cocolog-nifty.com</td>
                                    <td>Jess Gouldeby</td>
                                    <td>Moen Group</td>
                                    <td>5</td>
                                    <td>1</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>14</td>
                                    <td>mmatzld@msn.com</td>
                                    <td>Marys Matzl</td>
                                    <td>Emard-Gerhold</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>15</td>
                                    <td>gfranscionie@craigslist.org</td>
                                    <td>Gabrila Franscioni</td>
                                    <td>Gusikowski LLC</td>
                                    <td>4</td>
                                    <td>2</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>16</td>
                                    <td>cbookerf@blogs.com</td>
                                    <td>Cozmo Booker</td>
                                    <td>Dickinson-Klein</td>
                                    <td>1</td>
                                    <td>3</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>17</td>
                                    <td>alarkingg@elegantthemes.com</td>
                                    <td>Arlie Larking</td>
                                    <td>Rosenbaum Group</td>
                                    <td>4</td>
                                    <td>2</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>18</td>
                                    <td>yscogingsh@liveinternet.ru</td>
                                    <td>Yorker Scogings</td>
                                    <td>Gorczany LLC</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>19</td>
                                    <td>dmuscotti@bloomberg.com</td>
                                    <td>Dominick Muscott</td>
                                    <td>Swaniawski-Sipes</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>20</td>
                                    <td>lkynforthj@meetup.com</td>
                                    <td>Laurette Kynforth</td>
                                    <td>Torp-Satterfield</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>21</td>
                                    <td>blycettk@t.co</td>
                                    <td>Beryl Lycett</td>
                                    <td>Schoen Inc</td>
                                    <td>3</td>
                                    <td>3</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>22</td>
                                    <td>cboggasl@quantcast.com</td>
                                    <td>Carny Boggas</td>
                                    <td>Kuphal LLC</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>23</td>
                                    <td>daxelbym@about.me</td>
                                    <td>Dyana Axelby</td>
                                    <td>Runolfsdottir-Hayes</td>
                                    <td>2</td>
                                    <td>1</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>24</td>
                                    <td>oduffyn@de.vu</td>
                                    <td>Orelle Duffy</td>
                                    <td>Roberts and Sons</td>
                                    <td>5</td>
                                    <td>3</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>25</td>
                                    <td>tkindero@hud.gov</td>
                                    <td>Taylor Kinder</td>
                                    <td>Terry-Howell</td>
                                    <td>3</td>
                                    <td>1</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>26</td>
                                    <td>eaylesburyp@va.gov</td>
                                    <td>Emanuele Aylesbury</td>
                                    <td>Torp LLC</td>
                                    <td>3</td>
                                    <td>1</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>27</td>
                                    <td>dgibkeq@multiply.com</td>
                                    <td>Dorie Gibke</td>
                                    <td>Tremblay and Sons</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>28</td>
                                    <td>mharraginr@arstechnica.com</td>
                                    <td>Melisandra Harragin</td>
                                    <td>Turner-Cartwright</td>
                                    <td>5</td>
                                    <td>3</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>29</td>
                                    <td>blampetts@behance.net</td>
                                    <td>Berenice Lampett</td>
                                    <td>Johnston-Fritsch</td>
                                    <td>2</td>
                                    <td>2</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>30</td>
                                    <td>tmcmurthyt@psu.edu</td>
                                    <td>Tammie McMurthy</td>
                                    <td>Sipes, Conn and Stiedemann</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>31</td>
                                    <td>djoyesu@microsoft.com</td>
                                    <td>Dinnie Joyes</td>
                                    <td>Keebler Group</td>
                                    <td>5</td>
                                    <td>1</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>32</td>
                                    <td>kaxelbeyv@macromedia.com</td>
                                    <td>Kerianne Axelbey</td>
                                    <td>Wolff, Sporer and Bechtelar</td>
                                    <td>6</td>
                                    <td>1</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>33</td>
                                    <td>kmacterlaghw@dailymotion.com</td>
                                    <td>Kiley MacTerlagh</td>
                                    <td>Hauck Inc</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>34</td>
                                    <td>tshuttlex@washingtonpost.com</td>
                                    <td>Trula Shuttle</td>
                                    <td>Will-Morissette</td>
                                    <td>5</td>
                                    <td>1</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>35</td>
                                    <td>hbrisleny@4shared.com</td>
                                    <td>Hollis Brislen</td>
                                    <td>Lowe, Jaskolski and Gulgowski</td>
                                    <td>4</td>
                                    <td>2</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>36</td>
                                    <td>mbattinz@gov.uk</td>
                                    <td>Marsh Battin</td>
                                    <td>Fay LLC</td>
                                    <td>6</td>
                                    <td>1</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>37</td>
                                    <td>ppinnion10@state.tx.us</td>
                                    <td>Patrizio Pinnion</td>
                                    <td>Haag-Stokes</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>38</td>
                                    <td>idaouse11@yolasite.com</td>
                                    <td>Ilario Daouse</td>
                                    <td>Nitzsche, Davis and Romaguera</td>
                                    <td>3</td>
                                    <td>2</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>39</td>
                                    <td>bcoleborn12@upenn.edu</td>
                                    <td>Blisse Coleborn</td>
                                    <td>Bailey, Windler and Marquardt</td>
                                    <td>6</td>
                                    <td>2</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>40</td>
                                    <td>ajouannisson13@issuu.com</td>
                                    <td>Augustin Jouannisson</td>
                                    <td>Witting, Reilly and Morar</td>
                                    <td>3</td>
                                    <td>3</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>41</td>
                                    <td>kjennison14@slashdot.org</td>
                                    <td>Kaleena Jennison</td>
                                    <td>Johnston Inc</td>
                                    <td>5</td>
                                    <td>3</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>42</td>
                                    <td>mpetronis15@bandcamp.com</td>
                                    <td>Mariel Petronis</td>
                                    <td>Mitchell, Bashirian and Schroeder</td>
                                    <td>5</td>
                                    <td>3</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>43</td>
                                    <td>ascroggie16@youku.com</td>
                                    <td>Adamo Scroggie</td>
                                    <td>Cartwright Group</td>
                                    <td>4</td>
                                    <td>2</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>44</td>
                                    <td>lkilmartin17@bigcartel.com</td>
                                    <td>Lewiss Kilmartin</td>
                                    <td>Stroman-Orn</td>
                                    <td>3</td>
                                    <td>3</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>45</td>
                                    <td>csachno18@blogs.com</td>
                                    <td>Claretta Sachno</td>
                                    <td>Zemlak-Cruickshank</td>
                                    <td>4</td>
                                    <td>1</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>46</td>
                                    <td>bvan19@ebay.co.uk</td>
                                    <td>Bryn Van Castele</td>
                                    <td>Beier-Mante</td>
                                    <td>5</td>
                                    <td>2</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>47</td>
                                    <td>tgatch1a@4shared.com</td>
                                    <td>Tades Gatch</td>
                                    <td>Klocko, Koelpin and Nikolaus</td>
                                    <td>5</td>
                                    <td>2</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>48</td>
                                    <td>rjolland1b@artisteer.com</td>
                                    <td>Reinold Jolland</td>
                                    <td>Zieme-Funk</td>
                                    <td>4</td>
                                    <td>2</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>49</td>
                                    <td>kbrainsby1c@hibu.com</td>
                                    <td>Ky Brainsby</td>
                                    <td>Towne Inc</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                                <tr>
                                    <td>50</td>
                                    <td>sgiddings1d@samsung.com</td>
                                    <td>Sheryl Giddings</td>
                                    <td>Grimes, Ryan and Larkin</td>
                                    <td>3</td>
                                    <td>1</td>
                                    <td nowrap="nowrap"></td>
                                </tr>
                            </tbody>
                        </table>
                        <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

<!--end::Content-->
{{-- Scripts Section --}}
@section('scripts')
<script src="{{asset("js/pages/crud/ktdatatable/base/data-local.js?v=7.1.8")}}"></script>

<script type="text/javascript">

   /* var datatable = $('.my_datatable').KTDatatable({
        extensions: {
            checkbox: {
                vars: {
                    selectedAllRows: 'selectedAllRows',
                    requestIds: 'requestIds',
                    rowIds: 'meta.rowIds',
                },
            },
        }
   });
   */

</script>
@endsection
