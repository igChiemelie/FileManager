M.AutoInit();
$('#goToReg').on('click', (e) => {
    e.preventDefault();

    $('#loginCard').addClass('hide');
    $('#regCard').removeClass('hide');
});
$('#goToLogin').on('click', (e) => {
    e.preventDefault();

    $('#regCard').addClass('hide');
    $('#loginCard').removeClass('hide');
});

$('#loginForm').on('submit', function (e) {
    e.preventDefault();

    let email = $('#loginEmail').val();
    let pass = $('#loginPassword').val();
    let banye = true;
    let url = $(this).attr('action');
    let mtd = $(this).attr('method');

    $.ajax({
        type: mtd,
        url: url,
        data: { 'loginEmail': email, 'loginPassword': pass, 'banye': banye },
        success: (data) => {
            if (data == 200) {
                window.location.href = "./server/dash.php";
            } else if (data == 501) {
                // window.location.href = "./index.php";
                M.toast({ html: '<a href = "./index.php">TRY AGAIN</a>' });
                // window.location.href = "./tryAgain.html";
            } else if (data == 401) {
                M.toast({ html: 'Unathorized Access' });
            }
        }
    });
});



$('#regForm').submit(function (e) {
    e.preventDefault();

    let url = $(this).attr('action');
    let mtd = $(this).attr('method');
    let fName = $('#firstName').val();
    let lName = $('#lastName').val();
    let oName = $('#otherName').val();
    let pass = $('#password').val();
    let cPass = $('#cPassword').val();
    let email = $('#email').val();
    // let gender = $('#gender').val();
    let gender = $("input[name='gender']:checked").val();
    // let gender = $('input[name="gender"]').val();
    // let state = $('#state').val();

    if (fName != " " && lName != " " && gender != " "  && pass != " " && pass == cPass) {
        var formData = {
            firstName: fName,
            lastName: lName,
            oName: oName,
            password: pass,
            cPassword: cPass,
            gender: gender,
            // state: state,
            email: email,
            debanye: true,
        }

        $.ajax({
            url: url,
            type: mtd,
            data: formData,
            success: function (data) {
                if (data == 200) {
                    window.location.href = "./server/dash.php";
                } else if (data == 501) {
                    M.toast({ html: 'Internal server error' });
                }
            },
            error: function (err) {
                M.toast({ html: 'Network error!' });
            }
        });
    } else {
        M.toast({ html: 'Please ensure all fields are completed correctly.' });
    }
});

$('.dropdown-trigger').dropdown({
    coverTrigger: false,
});

$('#makeArticle').on('submit', function (e) {
    e.preventDefault();

   
    let articleImg = $('input[name="articleImg"]')[0].files[0];
    let makeArticleAction = true;
    let titleEmelie = articleImg.name;
    let title = $('#title').val();
    let mediaType = $('#mediaType').val();
    // console.log(mediaType);
    
    

    let formData = new FormData();

    
    formData.append('makeArticleAction', makeArticleAction);
    formData.append('title', title);
    formData.append('mediaType', mediaType);
    formData.append('articleImg', articleImg);

    let url = $(this).attr('action');
    let mtd = $(this).attr('method');
    // console.log('hre1');
    $.ajax({
        type: mtd,
        url: url,
        data: formData,
        processData: false,
        contentType: false,
        success: (data) => {
            if (data == 200) {  
                M.toast({ html: 'The file ' + titleEmelie+' has been uploaded.'});
                location.reload();
            } else if (data == 501) {
                M.toast({ html: 'Server Error! Please try again in 5 minutes.', displayLength: 6500, classes: 'error' });
            } else if (data == 401) {
                M.toast({ html: 'Unathorized Acces', displayLength: 6500, classes: 'error' });
            } else {
                M.toast({ html: data, displayLength: 6500, classes: 'error' })
            }
        }
    });
    // console.log('hre3');
});

$('#title').characterCounter();

$('.showDeleteBlogModal').on('click', function (e) {
    e.preventDefault();

    let articleId = $(this).parents('td').attr('data-id');
    let articleTitle = $(this).parents('td').attr('data-title');

    $('#delArticleTitle').val(articleTitle);
    $('#delArticleId').val(articleId);

    console.log(articleId);
    // console.log('#delArticleId');

    $('#delArticleTitle2').val(articleTitle);
    $('#delArticleId2').val(articleId);

    $('#delArticleTitle3').val(articleTitle);
    $('#delArticleId3').val(articleId);

    $('#delArtModal').modal('open');//show modal

    $('#delArtModal2').modal('open');//show modal
    $('#delArtModal3').modal('open');//show modal

   
    
});



$('#deleteArticle').on('click', function (e) {
    e.preventDefault();
    console.log('emelie');
    let articleData = {
        id: $('#delArticleId').val(),
        delArtAction: true
    }
    $.ajax({
        url: 'controller.php',
        type: 'POST',
        data: articleData,
        success: (res) => {
            if (res == 201) {
                M.toast({ html: 'Article successfully deleted!', classes: 'success', displayLength: 5000 });
                setTimeout(() => {
                    location.reload();
                }, 5000);
            } else {
                M.toast({ html: res, classes: error });
            }
        },
        error: (err) => {
            M.toast({ html: err });
        }
    })
});



$('#deleteArticle2').on('click', function (e) {
    e.preventDefault();
    console.log('emelie2');

    let articleData = {
        id: $('#delArticleId2').val(),
        delArtAction: true
    }
    $.ajax({
        url: 'controller.php',
        type: 'POST',
        data: articleData,
        success: (res) => {
            if (res == 201) {
                M.toast({ html: 'Article successfully deleted!', classes: 'success', displayLength: 5000 });
                setTimeout(() => {
                    location.reload();
                }, 5000);
            } else {
                M.toast({ html: res, classes: error });
            }
        },
        error: (err) => {
            M.toast({ html: err });
        }
    })
});


$('#deleteArticle3').on('click', function (e) {
    e.preventDefault();
    console.log('emelie4');

    let articleData = {
        id: $('#delArticleId3').val(),
        delArtAction: true
    }
    $.ajax({
        url: 'controller.php',
        type: 'POST',
        data: articleData,
        success: (res) => {
            if (res == 201) {
                M.toast({ html: 'Article successfully deleted!', classes: 'success', displayLength: 5000 });
                setTimeout(() => {
                    location.reload();
                }, 5000);
            } else {
                M.toast({ html: res, classes: error });
            }
        },
        error: (err) => {
            M.toast({ html: err });
        }
    })
});

// $('#cancelDel').modal('close');//close modal
$('#cancelDel').on('click', function (e) {
    $('.modal').modal('close');
    
});

$('#cancelDel2').on('click', function (e) {
    $('.modal').modal('close');
});

$('#cancelDel3').on('click', function (e) {
    $('.modal').modal('close');
});




$('.showEditBlogModal').on('click', function (e) {
    e.preventDefault();
    // console.log('edit');
    
    let editFileId = $(this).parents('td').attr('data-id');
    let Title = $(this).attr('data-title');
    // let editFile = $(this).attr('data-value');
    let articleCatId = $(this).parents('td').attr('data-categories');

    
    $('#title').val(Title);
    $('#title2').val(Title);
    $('#title3').val(Title);

    // $('#editArticleCat').val(articleCatId);
    $('#editArticleCat2').val(articleCatId);
    $('#editArticleCat3').val(articleCatId);

    $('#editFile').val();
    $('#editFile2').val();
    $('#editFile3').val();
    // console.log(editFile);
    $('#editFileId').val(editFileId);
    $('#editFileId2').val(editFileId);
    $('#editFileId3').val(editFileId);
    // $('select').formSelect();//re-render select 

    $('#editModal1').modal('open');//show modal
    $('#editModal2').modal('open');//show modal
    $('#editModal3').modal('open');//show modal

    $('#editForm').on('submit', function (e) {
        e.preventDefault();


        let articleImgg = $('input[name="articleImgg"]')[0].files[0];
        console.log(articleImgg);
        let editArtAction = true;
        let titleEmelie = articleImgg.name;
        let title = $('#title').val();
        // let mediaType = $('#editArticleCat').val();
        let fileName = $('#editFile').val();
        let id = $('#editFileId').val();
        // let mediaType = $('#mediaType').val();
        // console.log(mediaType);
        // console.log(id);



        let formData = new FormData();


        formData.append('editArtAction', editArtAction);
        formData.append('title', title);
        // formData.append('mediaType', mediaType);
        formData.append('articleImgg', articleImgg);
        formData.append('fileName', fileName);
        formData.append('id', id);

        let url = $(this).attr('action');
        let mtd = $(this).attr('method');
        console.log('hre1');
        $.ajax({
            type: mtd,
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            success: (data) => {
                if (data == 200) {
                    M.toast({ html: 'The file ' + titleEmelie + ' has been updated.' });
                    location.reload();
                } else if (data == 501) {
                    M.toast({ html: 'Server Error! Please try again in 5 minutes.', displayLength: 6500, classes: 'error' });
                } else if (data == 401) {
                    M.toast({ html: 'Unathorized Acces', displayLength: 6500, classes: 'error' });
                } else {
                    M.toast({ html: data, displayLength: 6500, classes: 'error' })
                }
            }
        });
        // console.log('hre3');
    });

    $('#editForm2').on('submit', function (e) {
        e.preventDefault();
        

        let articleImggg = $('input[name="articleImggg"]')[0].files[0];
        console.log(articleImggg);
        let editArtAction = true;
        let titleEmelie = articleImggg.name;
        console.log(titleEmelie);
        let title = $('#title2').val();
        let mediaType = $('#editArticleCat2').val();
        let fileName = $('#editFile2').val();
        let id = $('#editFileId2').val();
        // let mediaType = $('#mediaType').val();
        // console.log(mediaType);
        // console.log(id);



        let formData = new FormData();


        formData.append('editArtAction', editArtAction);
        formData.append('title', title);
        formData.append('mediaType', mediaType);
        formData.append('articleImggg', articleImggg);
        formData.append('fileName', fileName);
        formData.append('id', id);


        

        let url = $(this).attr('action');
        let mtd = $(this).attr('method');
        console.log('hre1');
        $.ajax({
            type: mtd,
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            success: (data) => {
                if (data == 200) {
                    M.toast({ html: 'The file ' + titleEmelie + ' has been updated.' });
                    location.reload();
                } else if (data == 501) {
                    M.toast({ html: 'Server Error! Please try again in 5 minutes.', displayLength: 6500, classes: 'error' });
                } else if (data == 401) {
                    M.toast({ html: 'Unathorized Acces', displayLength: 6500, classes: 'error' });
                } else {
                    M.toast({ html: data, displayLength: 6500, classes: 'error' })
                }
            }
        });
        // console.log('hre3');
    });

    $('#editForm3').on('submit', function (e) {
        e.preventDefault();


        let articleVid = $('input[name="articleVid"]')[0].files[0];
        console.log(articleVid);
        let editArtAction = true;
        let titleEmelie = articleVid.name;
        console.log(titleEmelie);
        let title = $('#title3').val();
        let mediaType = $('#editArticleCat3').val();
        let fileName = $('#editFile3').val();
        let id = $('#editFileId3').val();
        // let mediaType = $('#mediaType').val();
        // console.log(mediaType);
        // console.log(id);



        let formData = new FormData();


        formData.append('editArtAction', editArtAction);
        formData.append('title', title);
        formData.append('mediaType', mediaType);
        formData.append('articleVid', articleVid);
        formData.append('fileName', fileName);
        formData.append('id', id);



        let url = $(this).attr('action');
        console.log(url);
        let mtd = $(this).attr('method');
        console.log(mtd);
        console.log('hre1');
        $.ajax({
            type: mtd,
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            success: (data) => {
                if (data == 200) {
                    M.toast({ html: 'The file ' + titleEmelie + ' has been updated.' });
                    location.reload();
                } else if (data == 501) {
                    M.toast({ html: 'Server Error! Please try again in 5 minutes.', displayLength: 6500, classes: 'error' });
                } else if (data == 401) {
                    M.toast({ html: 'Unathorized Acces', displayLength: 6500, classes: 'error' });
                } else {
                    M.toast({ html: data, displayLength: 6500, classes: 'error' })
                }
            }
        });
        // console.log('hre3');
    });
});

