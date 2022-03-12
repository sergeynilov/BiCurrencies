// import { bus } from '../app'
// import appMixin from '../appMixin'
import axios from 'axios'
import {usePage} from '@inertiajs/inertia-vue3';
// import app from '@/main.js'
import {settingsAwesomeFontLabels} from '@/app.settings'
import moment from 'moment-timezone'

export function checkUrlPrefix(url) {
    if (!/^(f|ht)tps?:\/\//i.test(url)) {
        url = 'http://' + url
    }
    return url
}


export function showFlashMessage() {
    console.log('showFlashMessage  usePage().props::')
    console.log( usePage().props)
    //
    console.log('showFlashMessage usePage().props.value.flash::')
    console.log(usePage().props.value.flash)
    //
    // console.log('showFlashMessage page.props::')
    // console.log(page.props)
    //
    // console.log('showFlashMessage page.props.jetstream::')
    // console.log(page.props.jetstream)
    // console.log(Object.entries( page.props.jetstream) )

    //             console.log(' usePage().props.value.flash::')
    //             console.log( usePage().props.value.flash)
    // if (usePage().props.value.flash && usePage().props.value.flash.length > 0) {
    // export function getSplitted (str, splitter, index) {
    let icon = 'success'


    let flash_message = ''
    if ( !isEmpty(usePage().props.value.flash) && !isEmpty(usePage().props.value.flash.message) ) {
    // if (typeof usePage().props.value.flash != 'undefined' && typeof usePage().props.value.flash.message != 'undefined' && typeof usePage().props.value.flash.message.length != 'undefined' && usePage().props.value.flash.message.length > 0) {
        flash_message = usePage().props.value.flash.message

        console.log('INSIDE flash_message::')
        console.log(flash_message)
        console.log(typeof flash_message)

        let icon_type = getSplitted(flash_message, '_flash_type_', 0)
        let flash_message_2 = getSplitted(flash_message, '_flash_type_', 1)

        if (icon_type == 'warning') {
            flash_message = flash_message_2
            icon = 'warning'
        }

        if (icon_type == 'error') {
            flash_message = flash_message_2
            icon = 'error'
        }

        // console.log('icon::')
        // console.log(icon)
        // console.log('flash_message::')
        // console.log(flash_message)

        Toast.fire({
            icon: icon,
            title: flash_message
        })
    }
}

export function getErrorMessage(error) {
    console.log('getErrorMessage error::')
    console.log(typeof error)
    console.log(error)

    /*
                if (typeof error.response.status != 'undefined' && typeof error.response != 'undefined' && error.response.status === 400) {
                    if (typeof error.response.data.message != 'undefined') {
                        return "Validation error : " + error.response.data.message
                    }
                }
    */
    if (typeof error == 'object' /*&& typeof error != 'undefined' && error.response.status === 500*/) {
        let errorsList = Object.values(error)
        // console.log('errorsList::')
        // console.log(errorsList)
        /* getErrorMessage error::
appMixin.js?ec54:34 {0: 'message', 1: 'Currency # 36 not found 1 !' */
        if (typeof errorsList[0] != "undefined") {
            return "Runtime error : " + errorsList[0]
        }
    }
}

export function getFileSizeAsString(fileSize) {
    if (parseInt(fileSize) < 1024) {
        return fileSize + 'b'
    }
    if (parseInt(fileSize) < 1024 * 1024) {
        return Math.floor(fileSize / 1024) + 'kb'
    }
    return Math.floor(fileSize / (1024 * 1024)) + 'mb'
}

export function forumHasImage(forum) {
    if (typeof forum['filenameData'] === 'undefined') return false
    if (forum['filenameData'] === null) return false
    if (typeof forum['filenameData'].image_url === 'undefined') return false
    if (typeof forum['filenameData'].image_url === 'string') return true
    return true
}


export function moneyFormat(price) {
    if (typeof price === 'undefined' || typeof price === 'object') {
        price = 0
    }
    if (typeof price === 'string') {
        price = parseFloat(price)
    }
    return '$' + price.toFixed(2)
}

export function momentDatetime(datetime, datetimeFormat, defaultVal) {
    if (typeof datetime === 'undefined' || datetime === null) {
        if (typeof defaultVal !== 'undefined' && defaultVal !== null) {
            return defaultVal
        }
        return ''
    }
    if (typeof datetime === 'object') {
        return moment(datetime).format(datetimeFormat)
    }
    if (typeof datetime === 'string') {
        if (datetimeFormat === '') return ''
        let dt = moment(String(datetime))
        return dt.format(datetimeFormat)
    } // if (typeof datetime === "string") {
    return ''
} // momentDatetime(datetime, datetimeFormat, defaultVal) {

export function getDictionaryLabel(value, selectionsList, defaultValue) {
    if (typeof defaultValue === 'undefined') defaultValue = ''
    if (typeof selectionsList === 'undefined') return defaultValue
    var ret = defaultValue
    selectionsList.map((nextSelection/* , index */) => {
        if (nextSelection.code === value) {
            ret = nextSelection.label
        }
    })
    return ret
} // getDictionaryLabel( value, selectionsList, defaultValue ) {

export function upperCase(string) {
    if (typeof string !== 'string') return ''
    return string.toUpperCase()
}

export function lowerase(string) {
    if (typeof string !== 'string') return ''
    return string.toLowerCase(0)
}

export function concatStr(str, maxStrLengthInListing) {
    if (typeof str === 'undefined') str = ''
    if (str.length > maxStrLengthInListing) {
        return str.slice(0, maxStrLengthInListing) + '...'
    }
    return str
}

export function capitalize(string) {
    if (typeof string !== 'string') return ''
    return string.charAt(0).toUpperCase() + string.slice(1)
}

export function clearErrorMessage(s) {
    if (typeof s === 'undefined') return ''
    return capitalize(s.replace(/_/g, ' '))
}

export function timeInAgoFormat(value) {
    if (value === null || typeof value === 'undefined') return
    return capitalize(moment(value).fromNow())
}

//            {{ nextCategory.title }}<small> ( has {{ nextCategory.forums_count }} {{ pluralize3(nextCategory.forums_count, 'no forums',  'forum', 'forums') }} )</small>
// export function pluralize3(itemsLength, zeroLabel, singleLabel, pluralLabel) {
//   if (itemsLength <= 0) return zeroLabel
//   return itemsLength + ' ' + ( itemsLength > 1 ? pluralLabel : singleLabel )
// }

export function pluralize3(items_length, no_items_text, single_item_text, multi_items_text) {
    // console.log('pluralize3 items_length::')
    // console.log(items_length)
    // console.log(typeof items_length)
    if (typeof items_length !== 'number') return no_items_text // +" :12"
    if (items_length === 0) return no_items_text //  +" :13"
    if (items_length === 1) return single_item_text //  +" :14"
    if (items_length > 1) return multi_items_text //  +" :15"
}

export function pluralize(itemsLength, singleLabel, pluralLabel) {
    return itemsLength > 1 ? pluralLabel : singleLabel
}

export function clearTags(str) {
    if (typeof str !== 'string') return ''
    return str.replace(/<\/?[^>]+(>|$)/g, '')
}

export function getHeaderIcon(icon) {
    let retIcon = ''
    settingsAwesomeFontLabels.map((nextSettingsAwesomeFontLabel) => {
        if (nextSettingsAwesomeFontLabel.code === icon) {
            retIcon = nextSettingsAwesomeFontLabel.font
            return retIcon
        }
    })
    return retIcon
}

export function isEmpty(value) {
    if (typeof value === 'object') {
        if (value === null) return true
        if (value.length === 0) return true
    }
    if (value === undefined) return true
    if (value === null) return true
    if (value === '') return true
}

export function getSplitted(str, splitter, index) {
    if (typeof str === 'undefined') return ''
    var valuesArray = str.split(splitter)
    if (typeof valuesArray[index] !== 'undefined') {
        return valuesArray[index]
    }
    return ''
}

// function initTinyMCEEditor (bySelectorContainer, bySelector, width, height) { // eslint-disable-line
//
//
//   var deviceParams = effectiveDeviceWidth()
//   var calculated_width = getCalculatedWidth(deviceParams.width)
//   if (typeof calculated_width !== 'undefined') {
//     width = getCalculatedWidth(deviceParams.width)
//   }
//   // alert( "initTinyMCEEditor width::"+(width) + "  bySelectorContainer::"+bySelectorContainer)
//
//   var editor_config = {
//     path_absolute: '/',
//     selector: '#' + bySelectorContainer,
//
//     setup: function (editor) {
//       editor.on('change', function () {
//         var current_context = tinymce.get(bySelectorContainer).getContent()
//         // alert( "current_context::"+var_dump(current_context) )
//         $('#' + bySelector).html(current_context)
//       })
//     },
//
//     theme: 'modern',
//     width: width,
//     height: height,
//     plugins: [
//       'advlist autolink lists link image charmap print preview hr anchor pagebreak',
//       'searchreplace wordcount visualblocks visualchars code fullscreen',
//       'insertdatetime media nonbreaking save table contextmenu directionality',
//       'emoticons template paste textcolor colorpicker textpattern'
//     ],
//     toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media',
//     relative_urls: false,
//     file_browser_callback: function (field_name, url, type, win) {
//       var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
//       var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight
//
//       var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name
//       if (type === 'image') {
//         cmsURL = cmsURL + '&type=Images'
//       } else {
//         cmsURL = cmsURL + '&type=Files'
//       }
//
//       tinyMCE.activeEditor.windowManager.open({
//         file: cmsURL,
//         title: 'Filemanager',
//         width: x * 0.8,
//         height: y * 0.8,
//         resizable: 'yes',
//         close_previous: 'no'
//       })
//     }
//   }
//
//   tinymce.init(editor_config)
//   // alert( "AFTER initTinyMCEEditor::"+var_dump(-99) )
// }  // function initTinyMCEEditor(bySelectorContainer, bySelector, width, height) {

// export function getModalCalculatedHeight (device_height) {
//   if (device_height <= 320) {
//     // alert( -1 )
//     return 300
//   }
//   if (device_height > 320 && device_height <= 480) {
//     // alert( -2 )
//     return 300
//   }
//
//   if (device_height > 480 && device_height <= 600) {
//     // alert( -3 )
//     return 440
//   }
//
//   if (device_height > 600 && device_height <= 768) {
//     // alert( -4 )
//     return 560
//   }
//   if (device_height > 768 && device_height <= 1024) {
//     // alert( -5 )
//     return 720
//   }
//   if (device_height > 1024) {
//     // alert( -6 )
//     return 950
//   }
// }

/*
export function getModalCalculatedWidth (deviceWidth) {
  if (deviceWidth <= 320) {
    // alert( -11 )
    return 300
  }
  if (deviceWidth > 320 && deviceWidth <= 480) {
    // alert( -22 )
    return 320
  }

  if (deviceWidth > 480 && deviceWidth <= 600) {
    // alert( -33 )
    return 310
  }

  if (deviceWidth > 600 && deviceWidth <= 768) {
    // alert( -44 )
    return 560
  }
  if (deviceWidth > 768 && deviceWidth <= 1024) {
    // alert( -55 )
    return 720
  }
  if (deviceWidth > 1024) {
    // alert( -66 )
    return 950
  }
}

export function getCalculatedWidth (deviceWidth) {
  if (deviceWidth <= 320) {
    // alert( -1 )
    return 300
  }
  if (deviceWidth > 320 && deviceWidth <= 480) {
    // alert( -2 )
    return 320
  }

  if (deviceWidth > 480 && deviceWidth <= 600) {
    // alert( -3 )
    return 310
  }

  if (deviceWidth > 600 && deviceWidth <= 768) {
    // alert( -4 )
    return 470
  }
  if (deviceWidth > 768 && deviceWidth <= 1024) {
    // alert( -5 )
    return 480
  }
  if (deviceWidth > 1024) {
    // alert( -6 )
    return 650
  }
}
*/

// function checkEmail (value) {
//   regex = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/
//   return regex.test(value)
// }
//
// function checkInteger (value) {
//   regex = /^[0-9]+$/
//   return regex.test(value)
// }
//
// function checkisNormalInteger (str, can_be_zero) {
//   var n = Math.floor(Number(str))
//   if (can_be_zero) {
//     return String(n) === str && n >= 0
//   } else {
//     return String(n) === str && n > 0
//   }
// }
//
// function var_dump (oElem, from_line, till_line) {
//   if (typeof oElem === 'undefined') return 'undefined'
//   var sStr = ''
//   if (typeof (oElem) === 'string' || typeof (oElem) === 'number') {
//     sStr = oElem
//   } else {
//     var sValue = ''
//     for (var oItem in oElem) {
//       sValue = oElem[oItem]
//       if (typeof (oElem) === 'innerHTML' || typeof (oElem) === 'outerHTML') {
//         sValue = sValue.replace(/</g, '&lt;').replace(/>/g, '&gt;')
//       }
//       sStr += 'obj.' + oItem + ' = ' + sValue + '\n'
//     }
//   }
//   //alert( "from_line::"+(typeof from_line) )
//   if (typeof from_line === 'number' && typeof till_line === 'number') {
//     return sStr.substr(from_line, till_line)
//   }
//   if (typeof from_line === 'number') {
//     return sStr.substr(from_line)
//   }
//   return sStr
// }
