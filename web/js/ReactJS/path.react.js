var data = [
    {id: 1, libelle: 'Chef de projet Multimédia - Développement'},
];

var Path = React.createClass({
    render: function () {
        return(
            <tr>
                <td>
                    {this.props.libelle}
                </td>
                <td>
                    {this.props.id}
                </td>
            </tr>
        );
    }
});

var PathList = React.createClass({
    render: function () {
        var pathNodes = this.props.data.map(function (path) {
            return(
                <Path libelle={path.libelle} id={path.id} />
            );
        });
        return(
            <div className="path_list">
                {pathNodes}
            </div>
        );
    }
});

var PathBox = React.createClass({
    getInitialState: function () {
        return {
            data: data
        }
    },
    loadPathsFromServer: function () {
        $.ajax({
            url: this.props.url,
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
        this.loadPathsFromServer();
        setInterval(this.loadPathsFromServer, 5000);
    },
    render: function () {
        return(
            <PathList data={this.state.data} />
        );
    }
});

ReactDOM.render(
    <PathBox data={data} />,
    document.getElementById('exemple')
);