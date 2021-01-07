@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Metallic Permit</div>

                <div class="card-body">
                  <form action="" method="post">
                    @csrf

    <div class="form-group">
    <label for="otp_number">OTP Number</label>
    <input name="otp_number" class="form-control" id="otp_number" aria-describedby="emailHelp" placeholder="Enter OTP Number">

    @error('otp_number')
    <small class="text-danger">{{ $message}} </small>
    @enderror
    </div>

    <div class="form-group">
    <label for="name_permitee">Name of permitee</label>
    <input name="name_permitee" class="form-control" id="name_permitee" aria-describedby="emailHelp" placeholder="Enter name of permitee">

    @error('name_permitee')
    <small class="text-danger">{{ $message}} </small>
    @enderror
    </div>


    <div class="form-group">
    <label for="name_applicant">Name of applicant</label>
    <input name="name_applicant" class="form-control" id="name_applicant" aria-describedby="emailHelp" placeholder="Enter name of applicant">

    @error('name_applicant')
    <small class="text-danger">{{ $message}} </small>
    @enderror
    </div>

    <div class="form-group">
    <label for="or_number1">Paid Excise Tax</label>
    <input name="or_number1" class="form-control" id="orNumber1" aria-describedby="emailHelp" placeholder="Enter OR Number/ mm-dd-yy">

    @error('or_number1')
    <small class="text-danger">{{ $message}} </small>
    @enderror
    </div>

    <div class="form-group">
    <label for="or_number2">Paid Extraction Fee</label>
    <input name="or_number2" class="form-control" id="orNumber2" aria-describedby="emailHelp" placeholder="Enter OR Number/ mm-dd-yy">

    @error('or_number2')
    <small class="text-danger">{{ $message}} </small>
    @enderror
    </div>



    <div>
    <div class="col-md-12 mb-3" id="resultQuery"></div>

    <button type="button" id="search" class="btn btn-primary">Search</button>
    </div>
    <br>
    <div class="form-group">

    <table class="table">
  <thead>
    <tr>
      <th scope="col">OTP Number</th>
      <th scope="col">Name of Permitee</th>
      <th scope="col">Name of Applicant</th>
      <th scope="col">Cert Name</th>
      <th scope="col">Cert Date</th>
      <th scope="col">Extraction fee</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)

    <tr>
    <td> {{$user->control_no}} </td>
    <td> {{$user->permittee_name}} </td>
    <td> {{$user->applicant_name}} </td>
    <td> {{$user->certification_or}} </td>
    <td> {{$user->certification_date}} </td>
    <td> {{$user->receipt_no}} </td>
    </tr>

    @endforeach


  </tbody>
</table>
    {{ $users->links()}}

    </div>




                  </form>




                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token:]').attr('content')
            }
        });
        function loadData(otpNumber, nameOfPermitee,nameOfApplicant,orNumber1,orNumber2){
            $.ajax({
                type: 'POST',
                url:  '/metalicLoad',
                dataType:'json',
                data:{
                    _token:'{{ csrf_token() }}',
                    otp:otpNumber,
                    permitee:nameOfPermitee,
                    applicant:nameOfApplicant,
                    cert_or:orNumber1,
                    receipt:orNumber2,

                    },
                success: function(data){
                    console.log(data);
                    if(data ==  null){
                        $('#resultQuery').addClass('alert alert-danger').attr('role','alert').html('This permit is invalid!');
                    }else{
                        $('#resultQuery').removeClass('alert alert-danger');
                        $('#resultQuery').addClass('alert alert-success').attr('role','alert').html('<b>'+data.control_no+'</b> permit number is valid.');

                    }
                }
            })
        }

        $(document).on('click','#search', function() {
            var otp_number = $('#otp_number').val();
            var name_permitee = $('#name_permitee').val();
            var name_applicant = $('#name_applicant').val();
            var orNumber1 = $('#orNumber1').val();
            var orNumber2 = $('#orNumber2').val();
            loadData(otp_number,name_permitee,name_applicant,orNumber1,orNumber2)
        })
    })
</script>

@endsection
