let list = document.querySelector('#links');
const menu = document.querySelector('#burger-menu');

menu.addEventListener('click',function(){
    list.classList.toggle('left-0');
    list.classList.toggle('left-[-500px]');
});


const btnAddCourse = document.querySelector('#add-course');
const popup = document.querySelector('#popup');
const btnClosePopup = document.querySelector('#close');
const formAddCourse = document.querySelector('#add-form');

btnAddCourse.addEventListener('click',function(){
    popup.classList.remove('hidden');
    popup.classList.add('flex');
});

btnClosePopup.addEventListener('click',function(){
    popup.classList.add('hidden');
    popup.classList.remove('flex');
    formAddCourse.reset();
});

const selectType = document.querySelector('#type');
const courseDoc = document.querySelector('#document');
const courseVideo = document.querySelector('#video');

selectType.addEventListener('change', function(){
    let choice = selectType.value;

    if(choice === "Document"){
        courseDoc.classList.add('flex');
        courseDoc.classList.remove('hidden');
        courseVideo.classList.remove('flex');
        courseVideo.classList.add('hidden');
    }else{
        courseVideo.classList.add('flex');
        courseVideo.classList.remove('hidden');
        courseDoc.classList.remove('flex');
        courseDoc.classList.add('hidden');
    }
});