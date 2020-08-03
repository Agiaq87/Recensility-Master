/**
 *
 * @author Alesandro "Mr.Pixel" Giaquinto 
 * @package Recensility Master
 */

function tabChooser(id){
    var list = document.getElementsByClassName('RM-tab-panel');
    var tab = document.getElementById(id);
    
    console.log(document.getElementsByClassName('RM-tab-panel'));
    console.log(tab);
    
    for(i=0; i<list.length; i++){
        list[i].style.display = "none";
    }
    
    tab.style.display="block";
}