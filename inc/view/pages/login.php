<?php if (!defined('X')) die('Deny Access');?>
    <div class="form-signin">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mt-4">
                    <form action="login" method="post">
                        <h1 class="h3 mb-3 fw-normal">Giriş Yap</h1>
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {

                            $user = p('user');
                            $pass = p('pass');

                            // Hata kontrolü
                            if (empty($user) || empty($pass)) {
                                $error = ['message' => 'Kullanıcı adı ve şifre boş olamaz', 'type' => 'danger'];
                            } else {
                                // Kullanıcıyı veritabanından çek
                                $login = $db->selectOne('users', 'user_name', $user);
                                $uid = (int)($login['user_id'] ?? 0);

                                // Kullanıcı kontrolü
                                if ($uid < 1) {
                                    $error = ['message' => 'Kullanıcı bulunamadı', 'type' => 'danger'];
                                } elseif (!password_verify($pass, $login['user_pass'])) {
                                    $error = ['message' => 'Kullanıcı adı veya şifreniz hatalıdır', 'type' => 'danger'];
                                } else {
                                    // Başarılı giriş, oturumu başlat
                                    $_SESSION['onlines'] = [
                                        'id'    => $uid,
                                        'name'  => $login['user_name'],
                                        'group' => $login['user_group']
                                    ];
                                    go('home');
                                }
                            }

                            if (isset($error)) {
                                echo Alert($error['message'], $error['type']);
                            }
                        }
                        ?>

                        <div class="form-floating">
                          <input type="text" name="user" class="form-control" id="floatingInput" placeholder="Kullanıcı Adı">
                          <label for="floatingInput">Kullanıcı Adı</label>
                        </div>
                        <div class="form-floating">
                          <input type="password" name="pass" class="form-control" id="floatingPassword" placeholder="Şifreniz">
                          <label for="floatingPassword">Şifre</label>
                        </div>
                        <button class="w-100 btn btn-lg btn-primary" type="submit">Giriş Yap</button>

                    </form>
                </div>
            </div>
        </div>
    </div>