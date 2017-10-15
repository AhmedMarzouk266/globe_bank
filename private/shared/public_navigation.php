
   
<navigation>
    <?php $subject_set = find_all_subjects(['visible'=>true]);
        $page_id = $page_id ?? '0';
        $subject_id = $subject_id ?? '0';
    ?>
    
    <div>
        <ul class="subjects">
            <?php while($subject = mysqli_fetch_assoc($subject_set)){?> 
                <li class="<?php if($subject['id']==$subject_id){echo "selected";}?>">
                    <a href="<?php echo 'index.php?subject_id='.u($subject['id']);?>"><?php echo h($subject['menu_name']) ; ?></a>
                   
                    <ul class="pages">
                             <?php
                                 $page_set= find_pages_by_subject_id($subject['id'],['visible'=>true]);
                             ?>
                              <?php
                              while ($page = mysqli_fetch_assoc($page_set)){
                                  if($subject['id']==$subject_id){
                                ?> 
                          <li class="<?php if($page['id'] == $page_id){echo "selected";}?>">
                                 <a  href="<?php echo "index.php?id=".h(u($page['id']))."& subject_id=".u($subject['id']);?>" >
                                 <?php echo $page['menu_name']."<br>";?> 
                            
                              </a>
                          </li>
                      <?php }
                        } // end of WHILE  pages ?>
                    </ul>
                </li>
            <?php } // end of WHILE  subjects?>
        </ul>
    </div>
    
    <?php 
        mysqli_free_result($subject_set);
        mysqli_free_result($page_set); 
    ?>
</navigation>