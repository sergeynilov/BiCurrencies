
export const settingsAppColors = {
    confirmButtonColor: '#3085d6' ,
    cancelButtonColor: '#d33'
}

export const settingsCurrencyActiveLabels = [
    { code: 0, label: 'Inactive' },
    { code: 1, label: 'Yes, active' }
]

export const settingsCurrencyIsTopLabels = [
    { code: 0, label: 'Not is top' },
    { code: 1, label: 'Yes, is top' }
]

export const settingsJsMomentDatetimeFormat = 'Do MMMM, YYYY h:mm A'
export const settingsJsMomentDateFormat = 'Do MMMM, YYYY'
export const settingsEmptyImg = '/images/emptyImg.png'


//   `status` enum('N','A','I') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT ' N => New(Waiting activation), A=>Active, I=>Inactive',
export const settingsUserStatusLabels = [
    { code: 'A', label: 'Active' },
    { code: 'I', label: 'Inactive' },
    { code: 'N', label: 'New' },
    // { code: 'B', label: 'Banned' }

]

/////////////

export const settingsYesNoLabels = [
    { code: 0, label: 'No' },
    { code: 1, label: 'Yes' }
]



export const settingsAwesomeFontLabels = [   // https://fontawesome.com/v5.15/icons?d=gallery&p=2&m=free
    { code: 'cancel', font: 'fa fa-window-close' },
    { code: 'save', font: 'fa fa-save' },
    { code: 'add', font: 'fa fa-plus' },
    { code: 'edit', font: 'fa fa-edit' },
    { code: 'remove', font: 'fa fa-trash' },
    { code: 'clear', font: 'fa fa-trash' },
    { code: 'filter', font: 'fa fa-filter' },
    {code: 'info', font: 'fa fa-info' },
    {code: 'currency', font: 'fa fa-list' },
    {code: 'refresh', font: 'fa fa-redo' },
    { code: 'users', font: 'fa fa-users' },
    { code: 'currencies_history', font: 'fa fa-history' },
    { code: 'color', font: 'fa fa-palette' },
    { code: 'upload', font: 'fa fa-upload' },
    // ABOVE VALID


    { code: 'money', font: 'fa fa-money' },
    { code: 'published', font: 'fa fa-unlink' },
    { code: 'creator', font: 'fa fa-user' },


    { code: 'home', font: 'fa fa-home' },
    { code: 'task', font: 'fa fa-tasks' },
    { code: 'task_category', font: 'fa fa-object-group' },
    { code: 'server', font: 'fa fa-server' },
    { code: 'user_task_type', font: 'fa fa-id-badge' },
    { code: 'member_of_task', font: 'fa fa-user-plus ' },
    { code: 'member_of_task_2x', font: 'fa fa-2x fa-user-plus' },
    { code: 'free', font: 'fa fa-circle-o-notch' },
    { code: 'subscription', font: 'fa fa-envelope-open-o' },
    { code: 'email', font: 'fa fa-envelope' },
    { code: 'password', font: 'fa fa-unlock-alt' },
    { code: 'key', font: 'fa fa-key' },
    { code: 'login', font: 'fa fa-sign-in' },
    { code: 'register', font: 'fa fa-registered' },
    { code: 'profile', font: 'fa fa-user-md' },
    { code: 'participants', font: 'fa fa-users' },
    { code: 'user', font: 'fa fa-user' },
    { code: 'needs_reports', font: 'fa fa-flag' },
    { code: 'leader', font: 'fa fa-magnet' },
    { code: 'priority', font: 'fa fa-asterisk' },
    { code: 'priority_2x', font: 'fa fa-2x fa-asterisk' },
    { code: 'status', font: 'fa fa-battery-half' },
    { code: 'status_2x', font: 'fa fa-2x fa-battery-half' },
    { code: 'event', font: 'fa fa-calendar' },
    { code: 'events', font: 'fa fa-calendar' },
    { code: 'tag', font: 'fa fa-tag' },
    { code: 'description', font: 'fa fa-info-circle' },
    { code: 'past_date', font: 'fa fa-podcast' },
    { code: 'view', font: 'fa fa-eye' },
    { code: 'view_crossed_out', font: 'fa fa-eye-slash' },
    { code: 'tools', font: 'fa fa-wrench' },
    { code: 'check', font: 'fa fa-check' },
    { code: 'check-circle', font: 'fa fa-check-circle' },
    { code: 'check-square', font: 'fa fa-check-square' },
    { code: 'admin', font: 'fa fa-snapchat-ghost' },
    { code: 'manager', font: 'fa fa-graduation-cap' },
    { code: 'developer', font: 'fa fa-wheelchair-alt' },
    { code: 'has_no_access', font: 'fa fa-key' },
    { code: 'has_access', font: 'fa fa-unlock-alt' },
    { code: 'action', font: 'fa fa-exclamation-triangle' },
    { code: 'remove2x', font: 'fa fa-2x fa-trash' },
    { code: 'unremove', font: 'fa fa-building-o' },
    { code: 'unremove2x', font: 'fa fa-2x fa-building-o' },
    { code: 'demo-info', font: 'fa fa-info-circle' },
    { code: 'skill', font: 'fa fa-grav' },
    { code: 'dashboard', font: 'fa fa-th-large' },
    { code: 'settings', font: 'fa fa-cog' },
    { code: 'attach', font: 'fa fa-address-book' },
    { code: 'select', font: 'fa fa-mouse-pointer' },
    { code: 'toggle_on', font: 'fa fa-arrows-alt' },
    { code: 'weather', font: 'fa fa-sun-o' },
    { code: 'todo', font: 'fa-exclamation-circle' },
    { code: 'thunder', font: 'fa fa-bolt' },
    { code: 'today', font: 'fa fa-calendar-o' },
    { code: 'next_days', font: 'fa fa-calendar-check-o' },

    { code: 'toggle_off', font: 'fa fa-arrow-up' },
    { code: 'search', font: 'fa fa-search' },
    { code: 'activity_log', font: 'fa fa-table' },

    {code: 'export', font: 'fa fa-cubes'},
    {code: 'import', font: 'fa fa-database'},

    {code: 'maintenance', font: 'fa fa-truck'},
    {code: 'notification', font: 'fa fa-sticky-note-o'},
    {code: 'tree_has_items', font: 'fa fa-angle-right'},
    {code: 'lat_lan', font: 'fa fa-arrows'},
    {code: 'test', font: 'fa fa-bug' },
    {code: 'dictionaries', font: 'fa fa-list-ul' },
    {code: 'arrow_down', font: 'fa fa-arrow-down' },
    {code: 'arrow_up', font: 'fa fa-arrow-up' },
    {code: 'youtube', font: 'fa fa-youtube' },
    {code: 'sort_asc', font: 'fa fa-sort-amount-asc' },
    {code: 'sort_desc', font: 'fa fa-sort-amount-desc' },
    {code: 'drag', font: 'fa fa-hand-o-down' },
    {code: 'operation', font: 'fa fa-hand-o-down' },
    {code: 'error', font: 'fa fa-bug' },
    {code: 'image', font: 'fa fa-picture-o' },
]

export const settingsTaskPriorityLabels = [
    { code: '0', label: 'No' },
    { code: '1', label: 'Low' },
    { code: '2', label: 'Medium' },
    { code: '3', label: 'High' },
    { code: '4', label: 'Urgent' },
    { code: '5', label: 'Immediate' }
]

export const settingsTaskNeedsReportsLabels = [
    { code: '0', label: 'No' },
    { code: '1', label: 'Hourly' },
    { code: '2', label: 'Twice a day' },
    { code: '3', label: 'Daily' },
    { code: '4', label: 'Twice a week' },
    { code: '5', label: 'Weekly' }
]

export const settingsTaskIsHomepageLabels = [
    { code: 1, label: 'Is Homepage' },
    { code: 0, label: 'Is Not Homepage' },
]


export const settingsShowDeletedTasksLabels = [
    { code: 0, label: 'Show only non deleted tasks' },
    { code: 1, label: 'Show only deleted tasks' },
]

export const settingsTagTypeLabels = [
    { code: 'E', label: 'Events' },
    { code: 'P', label: 'Pages' },
    { code: 'T', label: 'Tasks' }
]

export const settingsUserStatusOnRegistrationLabels = [
    { code: 'N', label: 'New ( needs activation )' },
    { code: 'A', label: 'Active ( Can login at once )' },
]

export const settingsLogoImg = '/images/logo.png'
export const settingsLogoBigImg = '/images/logo_big.png'

export const settingsAdminLogoImg = '/images/admin_logo.png'
export const settingsAdminLogoBigImg = '/images/admin_logo_big.png'

export const settingsPriorityAsapRange = 4


export const settingsYoutubeApiKey= 'AIzaSyBaZAy1K4vIXDBiNn-18ggJqUgUdsSVq10'
export const settingsYoutubeSearchUrl= 'https://www.googleapis.com/youtube/v3/search'
export const settingsYoutubeMaxResults= 4
//

