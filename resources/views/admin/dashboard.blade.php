@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Központi adminisztrációs oldal</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3 class="mb-4">Bejelentkezési adatok:</h3>
                    <ul>
                      <li>Felhasználónév: <strong>{{ $user->username }}</strong></li>
                      <li>Csoportok (szerepkörök):
                        @if(count($userRoles))
                          @foreach($userRoles as $role)
                            <strong>
                              {{ $role }}
                              @if( !$loop->last )
                                {{ __(' + ') }}
                              @endif
                            </strong>
                          @endforeach
                        @else
                         {{ __('Nincs csoport') }}
                        @endif
                      </li>
                      <li>Utolsó bejelentkezés: 
                        <strong>
                          @if( !empty($user->last_login_at))
                            {{ $user->last_login_at }}
                          @else
                            {{ __('Első bejelentkezés.') }}
                          @endif
                        </strong>
                      </li>
                    </ul>
                    {{-- TOVÁBBÁ KILISTÁZHATÓ AZ ÖSSZES ADATBÁZISBAN LÉVŐ FELHASZNÁLÓ --}}
                    {{-- @if(count($allUsers))
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Felhasználónév</th>
                              <th scope="col">E-mail</th>
                              <th scope="col">Jogosultság</th>
                              <th scope="col">Utolsó bejelentkezés</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($allUsers as $simpleUser)
                                <tr>
                                  <th scope="row">{{ $loop->index+1 }}</th>
                                  <td>{{ $simpleUser->username }}</td>
                                  <td>{{ $simpleUser->email }}</td>
                                  <td> - </td>
                                  <td>
                                    @if (!empty($simpleUser->last_login_at))
                                      {{ $simpleUser->last_login_at }}
                                    @else
                                      Még nem jelentkezett be.
                                    @endif</td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                    @else 
                        <h3>Nincs megjelenítendő felhasználó! Ha ez látható, akkor van baj :)</h3>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
