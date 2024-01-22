function asyncRequest(){
    try{ // check for non-IE browseer
        var request = new XMLHttpRequest();
        // alert("REQUEST");
    }
    catch (e1){ 
        try{ // check for IE 6+
            request = new ActiveXObject("Msxm12.XMLHTTP");
        }
        catch (e2){
            try{ // check for IE 5
                request = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e3){
                request = false;
            }
        }
    }
    return request;
}