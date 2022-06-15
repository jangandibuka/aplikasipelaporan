<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->

        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/img/avatar5.png'); ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">

                <?php echo $this->session->userdata('first_name') . ' ' .  $this->session->userdata('last_name'); //. " " . $pic; 
                ?> </p>

                <p><?php //echo $this->ion_auth->is_admin() ? 'Admin' : 'Petugas'; 
                    if ($this->session->userdata('nama_toko') == 'ADMIN') {
                        echo 'Administrator';
                    } else if ($this->session->userdata('nama_toko') == 'Kampus') {
                        echo 'Petugas Kampus';
                    } else {
                        echo 'Petugas Kantor';
                    }  ?> </p>
            </div>
        </div>

        <!-- search form -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header bg-blue-active">MAIN NAVIGATION</li>
            <?php
            $id_user = $this->session->userdata('user_id');
            $search_user = $this->db->query("SELECT (CASE WHEN group_id = '1' THEN 'Administrator' WHEN group_id='2' THEN 'Admin' ELSE 'Office' END) as user_type FROM tb_users_groups WHERE user_id ='$id_user'")->row_array();
            // $search_user = $this->db->query("SELECT IF(group_id = '1', 'Administrator', group_id='2', 'Admin','Office') as user_type FROM tb_users_groups WHERE user_id=$id_user")->row_array();
            // var_dump($search_user);
            // die();
            // var_dump($search_user['user_type']);
            // die();
            $sql = "SELECT 
            menu.*, 
            IF(ma.id, 'Y', 'T') as akses 
            FROM `tb_menu` menu
            LEFT JOIN tb_menu_akses ma ON ma.id_menu = menu.id_menu
            WHERE menu.aktif='Y' AND ma.user_type='" . $search_user['user_type'] . "'";
            $main = $this->db->query($sql);
            $result = $main->result();

            $parent = array_filter($result, function ($v) {
                return $v->parent == '0';
            });

            foreach ($parent as $m) {
                // chek ada submenu atau tidak
                // $sub = $this->db->get_where('tb_menu', array('parent' => $m->id_menu, 'role' => 'Admin'));
                $id_menu = $m->id_menu;
                $sub = array_filter($result, function ($v) use ($id_menu) {
                    return $v->parent == $id_menu;
                });

                if (count($sub) > 0) {
                    // buat menu + sub menu
                    $uri = $this->uri->segment(1);
                    if ($this->uri->segment(2) != '') {
                        $uri .= '/' . $this->uri->segment(2);
                    }

                    // $idclass = $this->db->get_where('tb_menu', array('link' => $uri, 'role' => 'Admin'))->row_array();
                    $idclass = array_filter($result, function ($v) use ($uri) {
                        return $v->link === $uri;
                    });


                    if (count($idclass) > 0) {
                        if ($idclass[array_keys($idclass)[0]]->parent == $m->id_menu) {
                            $class = "active treeview";
                        } else {
                            $class = "";
                        }
                    } else {
                        $class = "";
                    }

                    echo '<li class=' . $class . '>' . anchor($m->link, '<i class="' . $m->icon . '"></i>
                            <span class="treeview">' . strtoupper($m->nama_menu) . '</span>
                            <b class="fa fa-angle-left pull-right"></b>', array('class' => 'dropdown-toggle'));
                    echo "<ul class='treeview-menu'>";
                    foreach ($sub as $s) {
                        $uri = $this->uri->segment(1);
                        if ($this->uri->segment(2) != '') {
                            $uri .= '/' . $this->uri->segment(2);
                        }
                        if ($s->link == $uri) {
                            $class1 = "active treeview";
                        } else {
                            $class1 = "";
                        }
                        // if()
                        echo '<li class=' . $class1 . '>' . anchor($s->link, '<i class="' . $s->icon . '"></i>' . strtoupper($s->nama_menu)) . '</li>';
                    }
                    echo "</ul>";
                    echo '</li>';
                } else {
                    // single menu
                    $uri = $this->uri->segment(1);
                    if ($this->uri->segment(2) != '') {
                        $uri .= '/' . $this->uri->segment(2);
                    }
                    if ($m->link == $uri) {
                        $class2 = "active";
                    } else {
                        $class2 = "";
                    }
                    echo '<li class=' . $class2 . '>' . anchor($m->link, '<i class="' . $m->icon . ' fa-lg">
                            </i>  <span class="treeview">' . strtoupper($m->nama_menu) . '</span>') . '</li>';
                }
            }
            ?>


            <?php
            // if ($this->ion_auth->is_admin()) {
            //     $main = $this->db->get_where('tb_menu', array('parent' => 0, 'role' => 'Admin'));
            //     foreach ($main->result() as $m) {
            //         // chek ada submenu atau tidak
            //         $sub = $this->db->get_where('tb_menu', array('parent' => $m->id_menu, 'role' => 'Admin'));
            //         if ($sub->num_rows() > 0) {
            //             // buat menu + sub menu
            //             $uri = $this->uri->segment(1);
            //             $idclass = $this->db->get_where('tb_menu', array('link' => $uri, 'role' => 'Admin'))->row_array();
            //             if ($m->id_menu == $idclass['parent']) {
            //                 $class = "active treeview";
            //             } else {
            //                 $class = "";
            //             }
            //             echo '<li class=' . $class . '>' . anchor($m->link, '<i class="' . $m->icon . '"></i>
            //                 <span class="treeview">' . strtoupper($m->nama_menu) . '</span>
            //                 <b class="fa fa-angle-left pull-right"></b>', array('class' => 'dropdown-toggle'));
            //             echo "<ul class='treeview-menu'>";
            //             foreach ($sub->result() as $s) {
            //                 $uri = $this->uri->segment(1);
            //                 if ($s->link == $uri) {
            //                     $class1 = "active treeview";
            //                 } else {
            //                     $class1 = "";
            //                 }
            //                 echo '<li class=' . $class1 . '>' . anchor($s->link, '<i class="' . $s->icon . '"></i>' . strtoupper($s->nama_menu)) . '</li>';
            //             }
            //             echo "</ul>";
            //             echo '</li>';
            //         } else {
            //             // single menu
            //             $uri = $this->uri->segment(1);
            //             if ($m->link == $uri) {
            //                 $class2 = "active";
            //             } else {
            //                 $class2 = "";
            //             }
            //             echo '<li class=' . $class2 . '>' . anchor($m->link, '<i class="' . $m->icon . ' fa-lg">
            //                 </i>  <span class="treeview">' . strtoupper($m->nama_menu) . '</span>') . '</li>';
            //         }
            //     }
            //     echo '<li class="header bg-blue-active">ADMIN NAVIGATION</li> ';
            //     $admin = $this->db->get_where('tb_menu', array('parent' => 0, 'role' => 'Administrator'));
            //     foreach ($admin->result() as $m) {
            //         // chek ada submenu atau tidak

            //         $sub = $this->db->get_where('tb_menu', array('parent' => $m->id_menu, 'role' => 'Administrator'));
            //         if ($sub->num_rows() > 0) {
            //             // buat menu + sub menu
            //             $uri = $this->uri->segment(1);
            //             $idclass = $this->db->get_where('tb_menu', array('link' => $uri, 'role' => 'Administrator'))->row_array();
            //             if ($m->id_menu == $idclass['parent']) {
            //                 $class = "active treeview";
            //             } else {
            //                 $class = "";
            //             }
            //             echo '<li class=' . $class . '>' . anchor($m->link, '<i class="' . $m->icon . '"></i>
            //                     <span class="treeview">' . strtoupper($m->nama_menu) . '</span>
            //                     <b class="fa fa-angle-left pull-right"></b>', array('class' => 'dropdown-toggle'));
            //             echo "<ul class='treeview-menu'>";
            //             foreach ($sub->result() as $s) {
            //                 $uri = $this->uri->segment(1);
            //                 if ($s->link == $uri) {
            //                     $class1 = "active treeview";
            //                 } else {
            //                     $class1 = "";
            //                 }
            //                 echo '<li class=' . $class1 . '>' . anchor($s->link, '<i class="' . $s->icon . '"></i>' . strtoupper($s->nama_menu)) . '</li>';
            //             }
            //             echo "</ul>";
            //             echo '</li>';
            //         } else {
            //             // single menu
            //             $uri = $this->uri->segment(1);
            //             if ($m->link == $uri) {
            //                 $class2 = "active";
            //             } else {
            //                 $class2 = "";
            //             }
            //             echo '<li class=' . $class2 . '>' . anchor($m->link, '<i class="' . $m->icon . ' fa-lg">
            //                     </i>  <span class="treeview">' . strtoupper($m->nama_menu) . '</span>') . '</li>';
            //         }
            //     }
            // } else {
            //     $main = $this->db->get_where('tb_menu', array('parent' => 0, 'role' => 'Admin'));
            //     foreach ($main->result() as $m) {
            //         // chek ada submenu atau tidak
            //         $sub = $this->db->get_where('tb_menu', array('parent' => $m->id_menu));
            //         if ($sub->num_rows() > 0) {
            //             // buat menu + sub menu
            //             $uri = $this->uri->segment(1);
            //             $idclass = $this->db->get_where('tb_menu', array('link' => $uri))->row_array();
            //             if ($m->id_menu == $idclass['parent']) {
            //                 $class = "active treeview";
            //             } else {
            //                 $class = "";
            //             }
            //             echo '<li class=' . $class . '>' . anchor($m->link, '<i class="' . $m->icon . '"></i>
            //                 <span>' . strtoupper($m->nama_menu) . '</span>
            //                 <b class="fa fa-angle-left pull-right"></b>', array('class' => 'dropdown-toggle'));
            //             echo "<ul class='treeview-menu'>";
            //             foreach ($sub->result() as $s) {
            //                 $uri = $this->uri->segment(1);
            //                 if ($s->link == $uri) {
            //                     $class1 = "active treeview";
            //                 } else {
            //                     $class1 = "";
            //                 }
            //                 echo '<li class=' . $class1 . '>' . anchor($s->link, '<i class="' . $s->icon . '"></i>' . strtoupper($s->nama_menu)) . '</li>';
            //             }
            //             echo "</ul>";
            //             echo '</li>';
            //         } else {
            //             $uri = $this->uri->segment(1);
            //             if ($m->link == $uri) {
            //                 $class2 = "active";
            //             } else {
            //                 $class2 = "";
            //             }
            //             echo '<li class=' . $class2 . '>' . anchor($m->link, '<i class="' . $m->icon . ' fa-lg">
            //                 </i>  <span>' . strtoupper($m->nama_menu) . '</span>') . '</li>';
            //         }
            //     }
            // }
            ?>

        </ul>
        <!--/.nav-list-->
    </section>
    <!-- /.sidebar -->
</aside>