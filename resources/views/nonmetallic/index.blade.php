@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Non-Metallic Permit</div>

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
    <label for="or_number1">Processing Fee</label>
    <input name="or_number1" class="form-control" id="orNumber1" aria-describedby="emailHelp" placeholder="Enter OR Number/ mm-dd-yy">

    @error('or_number1')
    <small class="text-danger">{{ $message}} </small>
    @enderror
    </div>


    <div class="form-group">
    <label for="or_number2">Paid Excise Tax</label>
    <input name="or_number2" class="form-control" id="orNumber2" aria-describedby="emailHelp" placeholder="Enter OR Number/ mm-dd-yy">

    @error('or_number2')
    <small class="text-danger">{{ $message}} </small>
    @enderror
    </div>

    <div class="form-group">
    <label for="or_number3">Paid Extraction Fee</label>
    <input name="or_number3" class="form-control" id="orNumber3" aria-describedby="emailHelp" placeholder="Enter OR Number/ mm-dd-yy">

    @error('or_number3')
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
      <th scope="col">Processing Fee Or No.</th>
      <th scope="col">Excise Tax Or No.</th>
      <th scope="col">Extraction Fee Or No.</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)

    <tr>
    <td> {{$user->otp_number}} </td>
    <td> {{$user->name_permitee}} </td>
    <td> {{$user->name_applicant}} </td>
    <td> {{$user->or4}} </td>
    <td> {{$user->or1}} </td>
    <td> {{$user->or2}} </td>
    </tr>
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
        function loadData(otpNumber, nameOfPermitee,nameOfApplicant,orNumber1,orNumber2,orNumber3){
            $.ajax({
                type: 'POST',
                url:  '/nonmetalicLoad',
                dataType:'json',
                data:{
                    _token:'{{ csrf_token() }}',
                    otp:otpNumber,
                    permitee:nameOfPermitee,
                    applicant:nameOfApplicant,
                    or1:orNumber1,
                    or2:orNumber2,
                    or3:orNumber3,
                    },
                success: function(data){
                    if(data ==  null){
                        $('#resultQuery').addClass('alert alert-danger').attr('role','alert').html('This permit is invalid!');
                    }else{
                        $('#resultQuery').removeClass('alert alert-danger');
                        $('#resultQuery').addClass('alert alert-success').attr('role','alert').html('<b>'+data.otp_number+'</b> permit number is valid.');

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
            var orNumber3 = $('#orNumber3').val();
            loadData(otp_number,name_permitee,name_applicant,orNumber1,orNumber2,orNumber3)
        })
    })
</script>

@endsection
