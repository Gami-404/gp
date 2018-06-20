@extends('layouts.app')

@section('content')
    <form action="{{route('search')}}" method="post">
        {{csrf_field()}}
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active show" data-toggle="tab" href="#education">Education</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#educations">Experience</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#personal">Personal Information</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#skills">Skills</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#others">Others</a>
            </li>
        </ul>

        <span class="dot">
    <div class="form-group center">
        <input style="float: right;margin: 40% 30% 30% 30%;font-size: 30px;" type="submit" name="login" id="submit"
               class="btn btn-success" value="submit"/>
    </div>
    </span>

        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active show tab-form" id="education">
                <div class="form-horizontal">
                    <div class="form-group">
                        <h4><i class="glyphicon glyphicon-envelope"></i>University</h4>
                        <input type="text" class="form-control" name="educations[university]" id="inputUniversity">
                        <div id="university-error"></div>
                    </div>

                    <div class="form-group">
                        <h4><i class="glyphicon glyphicon-lock"></i>Faculty</h4>
                        <input type="text" class="form-control" name="educations[name]" id="inputFaculty">
                        <div id="faculty-error"></div>
                    </div>
                    <div class="form-group">
                        <h4><i class="glyphicon glyphicon-lock"></i>Courses</h4>
                        <select class="form-control" multiple="multiple" name="educations[courses][]" id="inputCourses">
                        </select>
                        <div id="courses-error"></div>
                    </div>
                    <div class="form-group ">
                        <h3><i class="glyphicon glyphicon-tasks"></i>GPA</h3>
                        <select class="btn btn-success" name="educations[apa]" id="gpa">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade tab-form" id="educations">
                <div class="form-horizontal">
                    <div class="form-group ">
                        <h3><i class="glyphicon glyphicon-tasks"></i>Years of educations</h3>
                        <select class="btn btn-success" name="educationss[years]" id="years-of-educations">
                            <option>Fresh Graduated</option>
                            <option>Less than 1 year</option>
                            <option>+1 year</option>
                            <option>+2 years</option>
                            <option>+3 years</option>
                            <option>+4 years</option>
                            <option>+5 years</option>
                            <option>+6 years</option>
                            <option>+7 years</option>
                            <option>+8 years</option>
                            <option>Team Leader</option>

                        </select>
                    </div>


                    <div class="form-group">
                        <h4><i class="glyphicon glyphicon-lock"></i>Internships</h4>
                        <select name="educations[internships][]" class="form-control" multiple="multiple"
                                id="inputInternships"></select>
                        <div id="internships-error"></div>

                    </div>

                    <div class="form-group">
                        <h4><i class="glyphicon glyphicon-lock"></i>Organizations</h4>
                        <select name="educations[organizations][]" multiple="multiple" class="form-control"
                                id="inputOrganizations"></select>
                        <div id="organizations-error"></div>
                    </div>

                </div>

            </div>
            <div class="tab-pane fade tab-form " id="personal">

                <div class="form-horizontal">
                    <div class="form-group ">
                        <h3><i class="glyphicon glyphicon-tasks"></i>Military Status</h3>
                        <select class="btn btn-success" name="personal_data[military_status]"
                                id="input-military_status">
                            <option>Exemption</option>
                            <option>Postponed</option>
                            <option>Other</option>
                        </select>
                        <div id="gpa-msg"></div>
                    </div>

                    <div class="form-group">
                        <h4><i class="glyphicon glyphicon-lock"></i> Age</h4>
                        <input type="text" class="form-control" id="ageInput" name="personal_data[age]"/>
                        <div id="age-error"></div>

                    </div>

                </div>

            </div>
            <div class="tab-pane fade tab-form " id="skills">

                <div class="form-group dynamic-element" style="display:none">
                    <div class="row">
                        <div class="col-md-1"></div>

                        <!-- Replace these fields -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" id="inputSkills" name="skills[name][]"
                                       placeholder="Name"/>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <select id="proficiency" name="skills[proficiency][]" class="form-control">
                                <option value="">Proficiency</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <!-- End of fields-->
                        <div class="col-md-1">
                            <p class="delete">x</p>
                        </div>
                    </div>
                </div>
                <div class="form-container">
                    <div class="form-horizontal">
                        <fieldset>
                            <legend class="title">Skills</legend>
                            <div class="dynamic-stuff">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="add-one">new skill</p>
                                    </div>
                                    <div class="col-md-5"></div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade tab-form" id="others">

                <div class="form-horizontal">
                    <div class="form-group">
                        <h4><i class="glyphicon glyphicon-envelope"></i> Others</h4>
                        <input type="text" class="form-control" id="inputOthers" name="others">
                        <div id="others-error"></div>
                    </div>


                </div>

            </div>
        </div>
    </form>


@endsection



@push('js')
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/shared.css">
    <link rel="stylesheet" href="/assets/css/crieria.css">
    <script src="/assets/css/librariesV2/popper.min.js"></script>
    <style>
        .select2-container {
            width: 100% !important;
        }
    </style>
    <script src="/assets/js/criteria.js"></script>
    <script>
        $(function () {

            $('#inputCourses').select2({
                tags: true
            });
            $('#inputInternships').select2({
                tags: true
            });
            $('#inputOrganizations').select2({
                tags: true
            });
            $('#inputProjects').select2({
                tags: true
            });
        })
    </script>
    <script src="/assets/js/output.js"></script>
    <script src="/assets/js/jquery.dataTables.min.js">

    </script>
    <script src="/assets/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            debugger;
            $('#example').dataTable({
                "bDestroy": true,
                "ordering": false,
            });

        });
    </script>
@endpush
