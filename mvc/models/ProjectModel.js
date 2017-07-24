// Rename this to Schedule
function SchedulingProject(id, name) {
    this.id = id;
    this.name = name;
    this.shouts = [];
}

function SchedulingProjectModel() {
    this.projects = [];
}

SchedulingProjectModel.prototype.addProject = function(project) {
    this.projects.push(project);
};

SchedulingProjectModel.prototype.addShout = function(project_id, shout) {
    let project = this.projects.filter(project => project.id === project_id)[0];
    project.shouts.push(shout);
};

SchedulingProjectModel.prototype.loadProjects = function (callMeOnSuccess) {
    var _this = this;

    $.post(rootFolder + '/API.php', { method: 'get_all', type: 'SchedulingProject' }, function (data) {
               
        var obj = JSON.parse(data);

        // So we build a list of projects
        $.each(obj, function (key, val) {
            _this.addProject(new SchedulingProject(val.data.id, val.data.name));
        });

        var model = new ShoutModel();
        model.loadAllShouts(function() {

            if(model.shouts.length > 0) {
                model.shouts.forEach(function(element) {
                    _this.addShout(element.project_id, new Shout(element.id, element.project_id, element.text, element.date, element.time));
                });
            }
            callMeOnSuccess();   
        });

        /*
            Each project should have an array. Each project should be obtainable by id. Each project is currently in memory.

            // Step one: Allow all projects to load completely.
            // Step two: Load all of the shouts in the callback.
            // Step three: Get hold of the project in memory by id and append its shout.

        */
    });
};

SchedulingProjectModel.prototype.getProjects = function () {
    return this.projects;
};

SchedulingProjectModel.prototype.getProjectById = function (id) {
    return this.projects[id];
};

// Event handlers for these are attached in the view.

// Call this method and you're notifying the event that something's been added.
// The view knows then to do something.
SchedulingProjectModel.prototype.addItem = function (project) {
    this.projects.push(project);
};

SchedulingProjectModel.prototype.removeProjectWithId = function (id) {
    //var project = this.projects[id];
    //delete this.projects[id];

    this.projects = this.projects.filter(project => {project.id !== id});
};

SchedulingProjectModel.prototype.updateProject = function (project) {
    this.projects[project.id] = project;
};