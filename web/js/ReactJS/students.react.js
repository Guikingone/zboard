var data = [
    {firstname: 'Bernardo', lastname: 'De la vega !'}
];

var Student = React.createClass({
    render: function () {
        return(
            <tr>
                <td>
                    {this.props.firstname}
                </td>
                <td>
                    {this.props.lastname}
                </td>
            </tr>
        );
    }
});

var StudentList = React.createClass({
    render: function () {
        var studentNodes = this.props.data.map(function (student) {
            return(
                <Student firstname={student.firstname} lastname={student.lastname} />
            );
        });
        return(
            <div className="path_list">
                {studentNodes}
            </div>
        );
    }
});

var StudentBox = React.createClass({
    getInitialState: function () {
        return {
            data: data
        }
    },
    loadStudentFromServer: function () {
        $.ajax({
            url: this.props.url,
            type: 'GET',
            dataTypes: 'json',
            cache: false,
            success: function (data) {
                this.setState({data: data});
            }.bind(this),
            error: function (xhr, error, status) {
                consolog.log(this.props.url, status, err.toString());
            }.bind(this)
        });
    },
    componentDidMount: function () {
        this.loadStudentFromServer();
        setInterval(this.loadStudentFromServer, 2000);
    },
    render: function () {
        return(
            <StudentList data={this.state.data} />
        );
    }
});

ReactDOM.render(
    <StudentBox data={data} />,
    document.getElementById('exemple')
);